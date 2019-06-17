
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Insert title here</title>
<script type="text/javascript">
function encode_utf8(s) {
	  return unescape(encodeURIComponent(s));
	}

	function decode_utf8(s) {
	  return decodeURIComponent(escape(s));
	}
var palabra = encode_utf8("Terminar edición"); 
var palabra2 = decode_utf8( palabra); 
console.log(palabra);
console.log(palabra2);
</script>
</head>
<body>
<p>ó</p>
<footer>
        La capital de Espa&ntilde;a es Madrid
    </footer>
</body>
</html>