<? require_once 'partials/header.php'?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">График операций</h1>
</div>

<canvas class="my-4 w-100" id="myChart" width="900" height="380"></canvas>

<h2>Список транзакций</h2>

<div class="show-list-button">
  <button class="btn btn-secondary">Показать список</button>
</div>

<div class="table-responsive">
    <table class="table table-striped table-sm">

    </table>
</div>

<? require_once 'partials/footer.php'?>