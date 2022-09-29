<?php
require('dbconnect.php');
?>

<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>一覧</title>
  </head>
  <body>
    <h2>Books</h2>
    <table>
      <thead>
        <tr>
          <th>Title</th>
          <th>Body</th>
          <th></th>
          <th></th>
          <th></th>
        </tr>
      </thead>
      <tbody>

        <?php
        $stmt = $db->prepare('select * from books order by id desc');
        if(!$stmt){
          die($db->error);
        }
        $success = $stmt->execute();
        $stmt->bind_result($id, $title, $body);
        while($stmt->fetch()):
        ?>
        <tr>
          <td><?php echo htmlspecialchars($title); ?></td>
          <td><?php echo htmlspecialchars($body); ?></td>
          <td><a href="book.php?id=<?php echo $id; ?>">Show</a></td>
          <td><a href="edit.php?id=<?php echo $id; ?>">Edit</a></td>
          <td><a href="delete.php?id=<?php echo $id; ?>">Destroy</a></td>
        </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
    
    <h2>New book</h2>
    <form action="book_do.php" method="post">
      <p>Title</p>
      <textarea name="title" cols="20" rows="1" placeholder="タイトルを入力して下さい"></textarea>
      <p>Book</p>
      <textarea name="body" cols="20" rows="5" placeholder="感想を入力して下さい"></textarea>
      <button type="submit">Create Book</button>
    </form>
  </body>
</html>