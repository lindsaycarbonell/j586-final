$(function() {

	var apiurl = "https://api.instagram.com/v1/tags/campwriteunc/media/recent?access_token=1282853413.5ba2931.da04c2cfaff54d4f973385e8767419d1&callback=?&count=8"
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



				html += "<img class='insta-img' src ='" + data.images.low_resolution.url + "' />";


			});

			html+= "<a href='http://instagram.com/campwriteunc' id='insta-follow'>[Follow us on Instagram]</a>"

			console.log(html);
			$("#results").append(html);

		}


 });
