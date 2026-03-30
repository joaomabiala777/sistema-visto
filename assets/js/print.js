function printCard() {
    var card = document.getElementById("printable-card").outerHTML;
    var newWindow = window.open("", "", "width=1000,height=400");
    
    newWindow.document.write(`
        <html>
        <head>
            <link rel="stylesheet" href="../css/theme.css">
            <link rel="stylesheet" href="../css/style.css">
        </head>
        <body>
            ${card}
            <script>window.print(); window.close();</script>
        </body>
        </html>
    `);

    newWindow.document.close();
}
