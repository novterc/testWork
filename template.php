<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    </head>
    <body>

    <h1>Test work</h1>

        <div class="container">
            <div class="row">
                <div class="col-md-6">

                    <?php foreach ($errors as $error) { ?>
                        <div class="alert alert-danger"><?=$error?></div>
                    <?php } ?>

                    <form action="" method="POST">
                        <div class="form-group">
                            <label>Имя:</label>
                            <input type="text" class="form-control" name="name" value="<?=@$data['name']?>" />
                        </div>
                        <div class="form-group">
                            <label>Телефон:</label>
                            <input type="text" class="form-control" name="phone" value="<?=@$data['phone']?>" />
                        </div>
                        <div class="form-group">
                            <label>E-mail:</label>
                            <input type="email" class="form-control" name="email" value="<?=@$data['email']?>" />
                        </div>
                        <div class="form-group">
                            <label>Комментарий:</label>
                            <textarea name="comment" class="form-control" ><?=@$data['comment']?></textarea>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Отправить</button>
                        </div>
                    </form>

                    <button type="button" class="btn btn-info pull-right" data-toggle="modal" data-target="#myModal">Open Modal</button>
                </div>
            </div>
        </div>

        <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Modal Header</h4>
                    </div>
                    <div class="modal-body">
                        <p>Some text in the modal.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>

            </div>
        </div>


        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    </body>
</html>