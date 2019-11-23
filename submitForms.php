<?php 
require_once 'includes/header.php'; ?>
<!DOCTYPE HTML>
<html>
<head>
<style>
.f ol {
  list-style: none;
  counter-reset: my-awesome-counter;
}
.f li {
  counter-increment: my-awesome-counter;
  margin: 0.25rem;
  padding: 0.30rem;
}
.f li::before {
  content: counter(my-awesome-counter);
  background: #662974;
  width: 2rem;
  height: 2rem;
  border-radius: 50%;
  display: inline-block;
  line-height: 2rem;
  color: white;
  text-align: center;
  margin-right: 0.5rem;
}
.f ol ol li::before {
  background: #DE51FF;
}
.f ol ol ol li::before {
  background: #EE9EFF;
}

body {
  font-family: 'PT Serif', serif;
}
</style>
</head>
<body>
<div class="f">
<ol>
  <li>Medical forms<ol>
    <li><a href="#">Medical form (Annexature I)</a></li>
    <li><a href="#">Undertaking (Annexature I)</a></li>
  </ol></li>
  <li>Establishment</li>
  <li >Estate:<ol>
    <li><a href="form1.php">Requisition form for community centre</a></li>
	<li><a href="form2.php">Form for requesting iitbbs email</a></li>
  </ol></li>
</ol>

</body>
</html>
<?php require_once 'includes/footer.php'; ?>