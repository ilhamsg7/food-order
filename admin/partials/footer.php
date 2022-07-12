<!-- Mengeset cookies ke dalam website -->
<script>
		//set the cookie when they first hit the site
		function setCookie(c_name,value,exdays)
		{
			var exdate=new Date();
			exdate.setDate(exdate.getDate() + exdays);
			var c_value=escape(value) + ((exdays==null) ? "" : "; expires="+exdate.toUTCString());
			document.cookie=c_name + "=" + c_value;
		}

		//check for the cookie when user first arrives, if cookie doesn't exist call the intro.
		function getCookie(c_name)
		{
			var c_value = document.cookie;
			var c_start = c_value.indexOf(" " + c_name + "=");
			if (c_start == -1)
			{
				c_start = c_value.indexOf(c_name + "=");
			}
			if (c_start == -1)
			{
				c_value = null;
			}
			else
			{
				c_start = c_value.indexOf("=", c_start) + 1;
				var c_end = c_value.indexOf(";", c_start);
			if (c_end == -1)
			{
				c_end = c_value.length;
			}
				c_value = unescape(c_value.substring(c_start,c_end));
			}
			return c_value;
			}
	</script>

    <!-- Menambahkan sintaks js untuk translate -->
	<script src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

	<!-- Menghilangkan top bar tentang translate -->
	<style type="text/css">iframe.goog-te-banner-frame{ display: none !important;}</style>
	<style type="text/css">body {position: static !important; top:0px !important;}</style>

	<!-- Sintaks untuk translate -->
	<script>
		
		function googleTranslateElementInit(){
			new google.translate.TranslateElement({PageLanguage:'en'},'lang')
		}
		
	</script>
</body>
</html>