import ChartBuilder from "./ChartBuilder.js";

$(() => {
  // Построение графика
  const chartBuilder = new ChartBuilder('myChart');
  $.getJSON('/get_values.php', chartBuilder.build);

  let listShowed = false;

  // Загрузка таблицы с исходными данными
  $('.show-list-button button').on( 'click', () => {
    if (listShowed) {
      $('#modal-info .modal-body').text('Список уже загружен!');
      $('#modal-info').modal('show');
      return;
    }

    $.get({
      url: '/statement1.html',
      success: data => {
        listShowed = true;
        $('.table-responsive table').html($(data).find('table').html())
      },
      error: data => {
        console.log(data)
      }
    });
  });

});