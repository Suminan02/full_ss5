<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Table</title>
    <style>
       table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid rgb(236, 6, 6);
  text-align: left;
  padding: 8px;
}
thead{
    background-color: pink;
}
tr:nth-child(even) {
  background-color:rgb(230, 224, 224);
}
    </style>
</head>
<body>
    <h1>Table Name</h1>
    <table>
        <thead>
            <tr>
                <th>head 1</th>
                <th>head 2</th>
                <th>head 3</th>
                <th>head 4</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>info1</td>
                <td>info2</td>
                <td>info3</td>
                <td>info4</td>
            </tr>
            <tr>
                <td>data1</td>
                <td>data2</td>
                <td>data3</td>
                <td>data4</td>
            </tr>
            <tr>
                <td>doc1</td>
                <td>doc2</td>
                <td>doc3</td>
                <td>doc4</td>
            </tr>
        </tbody>
    </table>
</body>
</html>