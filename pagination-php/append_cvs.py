import glob
target = "/usr/local/cellar/apache-spark/2.2.1/final_all_3/code/target.csv"
tf = open(target, 'a')
for files in glob.glob("/Users/pallavikarthick/Downloads/*.csv"):
    print (files) 
    tf.write(open(files).read())
    tf.write("\n")
tf.close()
rating = "/usr/local/cellar/apache-spark/2.2.1/final_all_3/code/ratings.csv"
target = "/usr/local/cellar/apache-spark/2.2.1/final_all_3/code/target.csv"
rate_csv = open(rating, 'a')
rate_csv.write(open(target).read())
rate_csv.write("\n")
rate_csv.close()
