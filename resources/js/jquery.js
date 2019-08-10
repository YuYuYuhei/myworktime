$(function(){

    // var characters = {
    //     0: '00',
    //     yuno: 'ゆの',
    //     miyako: '宮子',
    //     sae: '沙英',
    //     hiro: 'ヒロ',
    //     nori: '乃莉',
    //     nazuna: 'なずな'
    // },
    // $select = $('.my-select'),
    // $option,
    // options,
    // isSelected;
    //
    // // コールバック関数の引数の順序が $.each と異なることに注意。
    // options = $.map(characters, function (name, value) {
    //     isSelected = (value === 'miyako' || value === 'nori');
    //     $option = $('<option>', { value: value, text: name, selected: isSelected });
    //     return $option;
    // });
    //
    // $select.append(options);

    var hour = $('#aaa').val();
    var hours = {
              0:'00',
              1:'01',
              2:'02',
              3:'03',
              4:'04',
              5:'05',
              6:'06',
              7:'07',
              8:'08',
              9:'09',
              10:'10',
              11:'11',
              12:'12',
              13:'13',
              14:'14',
              15:'15',
              16:'16',
              17:'17',
              18:'18',
              19:'19',
              20:'20',
              21:'21',
              22:'22',
              23:'23',
    },
    $selectHours = $('.my-hours'),
    $optionHours,
    optionsHours,
    isSelected;

    optionsHours = $.map(hours, function(name, value){
        isSelected = (name === hour)
        $optionHours = $('<option>', {value: value, text: name, selected: isSelected});
        return $optionHours;
    });

    $selectHours.append(optionsHours);
    //
    // var minute = $('#bbb').val();
    // var minutes = [
    //     '00', '01', '02', '03', '04', '05', '06', '07', '08', '09',
    //     '10', '11', '12', '13', '14', '15', '16', '17', '18', '19',
    //     '20', '21', '22', '23', '24', '25', '26', '27', '28', '29',
    //     '30', '31', '32', '33', '34', '35', '36', '37', '38', '39',
    //     '40', '41', '42', '43', '44', '45', '46', '47', '48', '49',
    //     '50', '51', '52', '53', '54', '55', '56', '57', '58', '59',
    // ],
    // $selectMinutes = $('.my-minutes'),
    // $optionMinutes,
    // optionsMinutes,
    // isSelected;
    //
    // // コールバック関数の引数の順序が $.each と異なることに注
    // optionsMinutes = $.map(minutes, function (name, value) {
    //      isSelected = (value === 'minute');
    //     $optionMinutes = $('<option>', { text: name, selected: isSelected });
    //     return $optionMinutes;
    // });
    //
    // $selectMinutes.append(optionsMinutes);

    // var hh = ['00', '01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23'];
    // var mm = {
    //      0:'00',
    //      10:'10',
    //      20:'20',
    //      30:'30',
    //      40:'40',
    //      50:'50'},
    // $select = $('.my-time'),
    // $option,
    // options;
    //
    // options = $.map(hh, function(time, value) {
    //     $option = $('<option>', { value:value, text:time });
    //     return $option;
    // });
    // $select.append(options);

    // var time = $('#abc').val();
    // $('#bcd').html('<input value=>');

    // var dt = $('#abc').val();
    // var hh = ['00', '01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23'];
    // var mm = ['00', '10', '20', '30', '40', '50'];
    // for (var i = 0; j < hh.length; ++i) {
    //     $('.bcde').attr('value', hh[i]).text(hh[i]);
    //         // $t.append(o);
    // }

    // $('#bcd').text(dt);


    // var current = new Date();
    // var year_val = current.getFullYear();
    // var month_val = current.getMonth() + 1;
    // var day_val = current.getDate();
    //
    // // プルダウン生成
    // $('<input type="">').html('<select name="ymd">');
    // for (var i = 0; i < 50; i++) {
    //
    //     var date = new Date(year_val, month_val - 1, day_val + i);
    //
    //     var y = date.getFullYear();
    //     var m = date.getMonth() + 1;
    //     var d = date.getDate();
    //
    //     $('select[name=ymd]').append('<option value="' + y + '/' + m + '/' + d + '">' + y + '/' + m + '/' + d + '</option>');
    // }




    // $('#datetime12').css('color', 'red');

});
