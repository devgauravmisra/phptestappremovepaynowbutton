<html>
    <head>
        <title>Custom PHP TEST APP</title>
    </head>
    <body>
        <h2>How to remove default pay now button</h2>
        <table>
            <form method="post" action="pay.php">
            <tr>
                 <td>
                     Name:
                 </td>
                 <td>
                     <input type="text" name="customer name" id="custname" placeholder="Customer name">
                 </td>
            </tr>
            <tr>
                 <td>
                     Contact:
                 </td>
                 <td>
                     <input type="number" name="customer contact" id="custcontact" placeholder="Customer contact">
                 </td>
            </tr>
            <tr>
                 <td>
                     Email:
                 </td>
                 <td>
                     <input type="email" name="customer email" id="custemail" placeholder="Customer Email">
                 </td>
            </tr>
            <tr>
                 <td>
                     Amount:
                 </td>
                 <td>
                     <input type="number" name="customer amount" id="custamt" placeholder="Amount">
                 </td>
            </tr>
            <tr>
                 <td>
                 <input type="submit" name="submit" value="Pay Now" >
                 </td>
                
            </tr>
</form>
       </table>
    </body>
</html>