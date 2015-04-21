<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>6</title>
<script src="http://codeorigin.jquery.com/jquery-2.0.3.min.js" type="text/javascript"></script>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet">

<style>
.col-lg-6{
	width:auto;
}
img{
	margin:5px 5px 5px 0px;
	border:2px solid #99badd;
	border-radius:3px;
	width:200px;
}
.embed-container{
	height:325px;
}

#results{
	height:325px;
}

</style>


</head>

<body>
<div class="row" id="results"></div>


<script>

$(function() {

	var apiurl = "https://api.instagram.com/v1/tags/campwriteunc/media/recent?access_token=1282853413.5ba2931.da04c2cfaff54d4f973385e8767419d1&callback=?"
	var access_token = location.hash.split('=')[1];
	var html = ""

		$.ajax({
			type: "GET",
			dataType: "json",
			cache: false,
			url: apiurl,
			success: parseData
		});



		function parseData(json){
			console.log(json);

			$.each(json.data,function(i,data){
				html += "<img src ='" + data.images.low_resolution.url + "' />";
				html += '<p>' + data.caption.text + '</p>';
			});

			console.log(html);
			$("#results").append(html);

		}


 });
</script>


</body>
</html>
