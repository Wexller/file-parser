<? require_once 'partials/header.php' ?>

  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Построить график</h1>
  </div>

  <h3 class="h4">Загрузите файл для построения графика</h3>

    <div class="row">
        <div class="col-4">
            <form action="/get_values.php" method="post" class="form__get-file" enctype="multipart/form-data">
                <div class="form-group">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="load-file" name="fileToUpload">
                        <label class="custom-file-label" for="load-file">Выберете файл...</label>
                    </div>
                </div>

                <button class="btn btn-primary" type="submit">Подтвердить</button>
            </form>
        </div>
    </div>

  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2" id="upload-filename"></h1>
  </div>

  <canvas class="my-4 w-100" id="myChart" width="900" height="380"></canvas>


<? require_once 'partials/footer.php' ?>