<html>
<head>
    <style>
        /** Define the margins of your page **/
        @page {
            margin: 100px 25px;
        }

        header {
            position: fixed;
            top: -60px;
            left: 0px;
            right: 0px;
            height: 50px;

            /** Extra personal styles **/
            background-color: #03a9f4;
            color: white;
            text-align: center;
            line-height: 35px;
        }

        footer {
            position: fixed;
            bottom: -60px;
            left: 0px;
            right: 0px;
            height: 50px;

            /** Extra personal styles **/
            background-color: #03a9f4;
            color: white;
            text-align: center;
            line-height: 35px;
        }
    </style>
</head>
<body>
<!-- Define header and footer blocks before your content -->
<header>
    Our Code World
</header>

<footer>
    Copyright &copy; <?php echo date("Y");?>
</footer>

<!-- Wrap the content of your PDF inside a main tag -->
<main>
    <p style="page-break-after: always;">
        Content Page 1
    </p>
    <p style="page-break-after: never;">
        Content Page 2
    </p>
</main>
</body>
</html>
