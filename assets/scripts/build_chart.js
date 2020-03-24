import ChartBuilder from "./ChartBuilder.js";

$(() => {
  const $fileField = $('#load-file');
  const $modal = $('#modal-info');

  let filename;

  // Добавление названия файла в поле файл
  $fileField.on('change',function() {
    filename = $(this).val().split('\\').pop();
    $(this).next('.custom-file-label').text(filename);
  });

  $('form').on('submit', function (event) {
    event.preventDefault();

    $('.file-invalid').remove();
    $fileField.removeClass('is-invalid');

    // Валидация формы
    if($fileField.val() === '') {
      $fileField.addClass('is-invalid');
      $fileField.after('<small class="text-danger file-invalid">Загрузите файл!</small>');
      return;
    }

    let chartBuilder = new ChartBuilder('myChart');

    const formData = new FormData();
    formData.append('fileToUpload', $('#load-file')[0].files[0]);

    // Отправка файла на сервер и построение графика в случае успеха
    $.post({
      url: $(this).attr('action'),
      data: formData,
      processData: false,
      contentType: false,
      success: data => {
        chartBuilder.build(JSON.parse(data));
        $('#upload-filename').text('График файла ' + filename);
        resetData(this);
      },
      error: data => {
        const json = JSON.parse(data.responseText);

        let result = '';
        for (let key in json) {
          result += `<p>${json[key]}</p>`;
        }

        $modal.find('.modal-body').html(result);
        $modal.modal('show');
        resetData(this);
      }
    })
  });

  const resetData = (form) => {
    $fileField.find('.custom-file-label').text('Выберете файл...');
    form.reset();
  }
});