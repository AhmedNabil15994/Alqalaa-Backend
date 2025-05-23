function PrintElem(htmlCode)
{
    var mywindow = window.open('', 'PRINT', 'height=1000,width=2000');

    mywindow.document.write(htmlCode);

    mywindow.document.close(); // necessary for IE >= 10
    mywindow.focus(); // necessary for IE >= 10*/

    mywindow.print();
    mywindow.close();

    return true;
}
