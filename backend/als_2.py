#
# Licensed to the Apache Software Foundation (ASF) under one or more
# contributor license agreements.  See the NOTICE file distributed with
# this work for additional information regarding copyright ownership.
# The ASF licenses this file to You under the Apache License, Version 2.0
# (the "License"); you may not use this file except in compliance with
# the License.  You may obtain a copy of the License at
#
#    http://www.apache.org/licenses/LICENSE-2.0
#
# Unless required by applicable law or agreed to in writing, software
# distributed under the License is distributed on an "AS IS" BASIS,
# WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
# See the License for the specific language governing permissions and
# limitations under the License.
#

from __future__ import print_function

import sys
if sys.version >= '3':
    long = int
	
import re
from pyspark.sql import SparkSession

# $example on$
from pyspark.ml.evaluation import RegressionEvaluator
from pyspark.ml.recommendation import ALS
from pyspark.sql import Row
from pyspark.sql.functions import UserDefinedFunction
from pyspark.sql.types import StringType
from pyspark.sql import functions as F
from pyspark.sql.functions import col, split
# $example off$

import pandas as pd
import sqlalchemy

if __name__ == "__main__":
    spark = SparkSession\
        .builder\
        .appName("ALSExample")\
        .getOrCreate()

    # $example on$
    lines = spark.read.text("sample_movielens_ratings_100K.txt").rdd
    parts = lines.map(lambda row: row.value.split("::"))
    ratingsRDD = parts.map(lambda p: Row(userId=int(p[0]), movieId=int(p[1]),
                                         rating=float(p[2]), timestamp=long(p[3])))
    ratings = spark.createDataFrame(ratingsRDD)
    (training, test) = ratings.randomSplit([0.6, 0.4])

    # Build the recommendation model using ALS on the training data
    # Note we set cold start strategy to 'drop' to ensure we don't get NaN evaluation metrics
    als = ALS(maxIter=5, regParam=0.01, userCol="userId", itemCol="movieId", ratingCol="rating",coldStartStrategy="drop")
    model = als.fit(training)

    # Evaluate the model by computing the RMSE on the test data
    predictions = model.transform(test)
    evaluator = RegressionEvaluator(metricName="rmse", labelCol="rating",
                                    predictionCol="prediction")
    rmse = evaluator.evaluate(predictions)
    print("Root-mean-square error = " + str(rmse))

    # Generate top 10 movie recommendations for each user
    userRecs = model.recommendForAllUsers(25)
	
    userRecs_1 = userRecs.select(userRecs['userId'],userRecs['recommendations.movieId'].cast("string").alias('movies'))
	
    userRecs_2 = userRecs_1.select(userRecs_1['userId'],F.split(userRecs_1.movies,',').getItem(0),F.split(userRecs_1.movies,',').getItem(1),F.split(userRecs_1.movies,',').getItem(2),F.split(userRecs_1.movies,',').getItem(3),F.split(userRecs_1.movies,',').getItem(4),F.split(userRecs_1.movies,',').getItem(5),F.split(userRecs_1.movies,',').getItem(6),F.split(userRecs_1.movies,',').getItem(7),F.split(userRecs_1.movies,',').getItem(8),F.split(userRecs_1.movies,',').getItem(9),F.split(userRecs_1.movies,',').getItem(10),F.split(userRecs_1.movies,',').getItem(11),F.split(userRecs_1.movies,',').getItem(12),F.split(userRecs_1.movies,',').getItem(13),F.split(userRecs_1.movies,',').getItem(14),F.split(userRecs_1.movies,',').getItem(15),F.split(userRecs_1.movies,',').getItem(16),F.split(userRecs_1.movies,',').getItem(17),F.split(userRecs_1.movies,',').getItem(18),F.split(userRecs_1.movies,',').getItem(19),F.split(userRecs_1.movies,',').getItem(20),F.split(userRecs_1.movies,',').getItem(21),F.split(userRecs_1.movies,',').getItem(22),F.split(userRecs_1.movies,',').getItem(23),F.split(userRecs_1.movies,',').getItem(24))
	
    userRecs_2 = userRecs_2.withColumnRenamed("split(movies, ,)[0]", "movieid1").withColumnRenamed("split(movies, ,)[1]","movieid2").withColumnRenamed("split(movies, ,)[2]","movieid3").withColumnRenamed("split(movies, ,)[3]","movieid4").withColumnRenamed("split(movies, ,)[4]","movieid5").withColumnRenamed("split(movies, ,)[5]","movieid6").withColumnRenamed("split(movies, ,)[6]","movieid7").withColumnRenamed("split(movies, ,)[7]","movieid8").withColumnRenamed("split(movies, ,)[8]","movieid9").withColumnRenamed("split(movies, ,)[9]","movieid10").withColumnRenamed("split(movies, ,)[10]","movieid11").withColumnRenamed("split(movies, ,)[11]","movieid12").withColumnRenamed("split(movies, ,)[12]","movieid13").withColumnRenamed("split(movies, ,)[13]","movieid14").withColumnRenamed("split(movies, ,)[14]","movieid15").withColumnRenamed("split(movies, ,)[15]","movieid16").withColumnRenamed("split(movies, ,)[16]","movieid17").withColumnRenamed("split(movies, ,)[17]","movieid18").withColumnRenamed("split(movies, ,)[18]","movieid19").withColumnRenamed("split(movies, ,)[19]","movieid20").withColumnRenamed("split(movies, ,)[20]","movieid21").withColumnRenamed("split(movies, ,)[21]","movieid22").withColumnRenamed("split(movies, ,)[22]","movieid23").withColumnRenamed("split(movies, ,)[23]","movieid24").withColumnRenamed("split(movies, ,)[24]","movieid25")
	
    userRecs_2 = userRecs_2.withColumn('movieid1',F.translate('movieid1','[',''))
    userRecs_2 = userRecs_2.withColumn('movieid25',F.translate('movieid25',']',''))
	
    #userRecs_2.printSchema()
    #userRecs_2.show()

    # Import dataframe into MySQL
    
    #userRecs_2.write.format('jdbc').options(url='jdbc:mysql://us-cdbr-iron-east-05.cleardb.net/heroku_54c3b520208a1ef?useServerPrepStmts=false&rewriteBatchedStatements=true', driver='com.mysql.jdbc.Driver',dbtable='collab_reco',user='ba0dd49e70befd',password='e8e0885d').mode('append').save()

    spark.stop()