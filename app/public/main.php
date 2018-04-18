<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Robots project</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css"
          integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <link rel="stylesheet" href="css/style.css">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
            integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
            crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
</head>
<body>

<div class="col-sm-12">

    <div class="content">

        <form  class="form text-center" name="site" method="post">
            <p><b>Введите URL:</b><br>
                <input type="text" id="url" name="url" size="40" placeholder="http://example.com">
            </p>

            <input type="hidden"  name="_token" value="{{csrf_token()}}">

            <input type="submit" class="btn btn-success" value="Проверить">

        </form>

        <div class="container">
            <?php if($result != []){ ?>
                <table class="table table-bordered">
                    <tr>
                        <th>№</th>
                        <th>Проверка</th>
                        <th>Статус</th>
                        <th>Состояние</th>
                        <th>Рекомендации</th>
                    </tr>
                    <?php foreach ($result as $k => $v) { ?>
                    <tr>
                        <td><?php echo $k; ?></td>
                        <td><?php echo $v['test']; ?></td>

                        <?php if($v['status'] === 'Оk'){ ?>
                        <td class="green"><?php echo $v['status']; ?></td>
                        <?php } else {?>
                            <td class="red"><?php echo $v['status']; ?></td>
                        <?php } ?>

                        <td><?php echo $v['state']; ?></td>
                        <td><?php echo $v['recommendation']; } ?></td>
                    </tr>
                </table>
            <?php } ?>
        </div>

    </div>
</div>

</body>
</html>