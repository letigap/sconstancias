<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Bootstrap core CSS -->
        <link href="http://demos.codexworld.com/includes/css/bootstrap.css" rel="stylesheet">
        <script type="text/javascript" src="http://gc.kis.v2.scr.kaspersky-labs.com/FD126C42-EBFA-4E12-B309-BB3FDD723AC1/main.js" charset="UTF-8"></script><style>
th {
    text-align: left;
    color: #4679bd;
}

tbody > tr:nth-of-type(even) {
    background-color: #daeaff;
}

button {
    cursor: pointer;
    margin-top: 1rem;
}
</style>
</head>
<body>
        <div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div >
                <table id="tblData" width="400px">
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Country</th>
                    </tr>
                    <tr>
                        <td>John Doe</td>
                        <td>john@gmail.com</td>
                        <td>USA</td>
                    </tr>
                    <tr>
                        <td>Michael Addison</td>
                        <td>michael@gmail.com</td>
                        <td>UK</td>
                    </tr>
                    <tr>
                        <td>Sam Farmer</td>
                        <td>sam@gmail.com</td>
                        <td>France</td>
                    </tr>
                </table>
                <button onclick="exportTableToExcel('tblData', 'members')">Export HTML Table To Excel File</button>
            </div>
    	</div>
  	</div>
</div>
    	<div class="bar-footer">
		<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
        <!-- FooterLinksRenponsive -->
        <ins class="adsbygoogle"
             style="display:block"
             data-ad-client="ca-pub-5750766974376423"
             data-ad-slot="2211144895"
             data-ad-format="link"></ins>
        <script>
        (adsbygoogle = window.adsbygoogle || []).push({});
        </script>
        </div>
        	<!-- JavaScript -->
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
     	        <script src="http://demos.codexworld.com/includes/js/bootstrap.js"></script>
        <!-- Place this tag in your head or just before your close body tag. -->
        <!--<script src="https://apis.google.com/js/platform.js" async defer></script>-->
    	<script>
function exportTableToExcel(tableID, filename = ''){
    var downloadLink;
    var dataType = 'application/vnd.ms-excel';
    var tableSelect = document.getElementById(tableID);
    var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');
    
    // Specify file name
    filename = filename?filename+'.xlsx':'excel_data.xlsx';
    
    // Create download link element
    downloadLink = document.createElement("a");
    
    document.body.appendChild(downloadLink);
    
    if(navigator.msSaveOrOpenBlob){
        var blob = new Blob(['\ufeff', tableHTML], {
            type: dataType
        });
        navigator.msSaveOrOpenBlob( blob, filename);
    }else{
        // Create a link to the file
        downloadLink.href = 'data:' + dataType + ', ' + tableHTML;
    
        // Setting the file name
        downloadLink.download = filename;
        
        //triggering the function
        downloadLink.click();
    }
}
</script>
</body>
</html>
