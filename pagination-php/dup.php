<?php
include "config.php";
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Filmfix</title>
    <link href="style.css" rel="stylesheet"/>
</head>
<body>

<script>
function exportTableToCSV(filename) {
    var csv = [];
    var rows = document.querySelectorAll("table tr");
    k=0;
    for (var i = 0; i < rows.length; i++) {
        var row = [], cols = rows[i].querySelectorAll("td,th");
        rating = document.querySelectorAll(".rating");
        len = document.querySelectorAll(".rating").length;
        console.log(rating[k].value)
       
        for (var j = 0; j < cols.length; j++) {
         
            //document.getElementById("demo1").innerHTML = cols[0].innerText;
            //document.getElementById("demo2").innerHTML = rating[i].value;
            //document.getElementById("demo3").innerHTML = cols[1].innerText;
            //document.getElementById("demo4").innerHTML = cols[j].innerText;
            if (i!=0 && j==2){
                row.push(rating[k].value);
                k++; 
            }
            else{
            row.push(cols[j].innerText);
            }
            console.log( row );
            
        }
        
        csv.push(row.join(",")); 
         
         
    }

    // Download CSV file
    downloadCSV(csv.join("\n"), filename);
}

function downloadCSV(csv, filename) {
    var csvFile;
    var downloadLink;

    // CSV file
    csvFile = new Blob([csv], {type: "text/csv"});

    // Download link
    downloadLink = document.createElement("a");

    // File name
    downloadLink.download = filename;

    // Create a link to the file
    downloadLink.href = window.URL.createObjectURL(csvFile);

    // Hide download link
    downloadLink.style.display = "none";

    // Add the link to DOM
    document.body.appendChild(downloadLink);

    // Click download link
    downloadLink.click();
}

</script>
    <div class="container">
        <h1 style="text-align:center">Rate movies to get fresh Recommendations!!</h1>
        <table class="table">
        <thead>
                        <tr>
                            <th>Movie Id</th>
                            <th width="60%">Title</th>
                            <th width="25%">Rating</th>
                        </tr>
                        </thead>
            <tbody>
                <?php for( $i = 0; $i < count( $results->data ); $i++ ) : ?>
                        <tr>
                                <td><?php echo $results->data[$i]['movieId']; ?></td>
                                <td><?php echo $results->data[$i]['title']; ?></td>
                                <td><input class="rating" name="rating" type="number" min="1" step="0.1" /></td>
                            
                        </tr>
                <?php endfor; ?>
            </tbody>
        </table>
        <?php echo $paginator->createLinks($links , 'pagination pagination-sm'); ?> 
        <button onclick="exportTableToCSV('new_rating.csv')"> Save ratings to CSV File</button>
        <p id="demo"></p>
    </div>
</body>

</html>