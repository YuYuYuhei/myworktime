$(function(){

    //------------------
    //プルダウンメニュー at create.blade.php, edit.blade.php
    var hh = [
              '00',
              '01',
              '02',
              '03',
              '04',
              '05',
              '06',
              '07',
              '08',
              '09',
              '10',
              '11',
              '12',
              '13',
              '14',
              '15',
              '16',
              '17',
              '18',
              '19',
              '20',
              '21',
              '22',
              '23',
            ];

     var mm = [
                '00',
                '01',
                '02',
                '03',
                '04',
                '05',
                '06',
                '07',
                '08',
                '09',
                '10',
                '11',
                '12',
                '13',
                '14',
                '15',
                '16',
                '17',
                '18',
                '19',
                '20',
                '21',
                '22',
                '23',
                '24',
                '25',
                '26',
                '27',
                '28',
                '29',
                '30',
                '31',
                '32',
                '33',
                '34',
                '35',
                '36',
                '37',
                '38',
                '39',
                '40',
                '41',
                '42',
                '43',
                '44',
                '45',
                '46',
                '47',
                '48',
                '49',
                '50',
                '51',
                '52',
                '53',
                '54',
                '55',
                '56',
                '57',
                '58',
                '59',
            ];

    //-------------------------------
    // breakInDefプルダウン処理 create.blade.php

    var breakInDef = $('#breakInDef').val();
    var breakInDefSplit = breakInDef.split(' ');
    var breakInDefYmd = breakInDefSplit[0];
    var breakInDefHis = breakInDefSplit[1];
    var breakInDefHisSplit = breakInDefHis.split(':');
    var breakInDefH = breakInDefHisSplit[0];
    var breakInDefM = breakInDefHisSplit[1];
    var breakInDefS = breakInDefHisSplit[2];

    var hh,
    $selectBreakInDefHour = $('#selectBreakInDefHour'),
    $optionBreakInDefHours,
    optionsBreakInDefHours,
    isSelectedBreakInDefHour;
    optionsBreakInDefHours = $.map(hh, function(name, value){
            isSelectedBreakInDefHour = (name === breakInDefH);
            $optionBreakInDefHours = $('<option>', {value: value, text: name, selected: isSelectedBreakInDefHour});
            return $optionBreakInDefHours;
        });
    $selectBreakInDefHour.append(optionsBreakInDefHours);

    var mm,
    $selectBreakInDefMinute = $('#selectBreakInDefMinute'),
    $optionBreakInDefMinutes,
    optionsBreakInDefMinutes,
    isSelectedBreakInDefMinute;
    optionsBreakInDefMinutes = $.map(mm, function(name, value){
            isSelectedBreakInDefMinute = (name === breakInDefM);
            $optionBreakInDefMinutes = $('<option>', {value: value, text: name, selected: isSelectedBreakInDefMinute});
            return $optionBreakInDefMinutes;
        });
    $selectBreakInDefMinute.append(optionsBreakInDefMinutes);

    $('#breakInDefYmd').val(breakInDefYmd);
    $('#breakInDefYmd').datepicker({
        dateFormat: 'yy-mm-dd',
    });

    $('#createPunchInBtn').click(function(){
        var breakInDefYmdEdited = $('#breakInDefYmd').val();
        var breakInDefHEdited = $('select[id=selectBreakInDefHour] > option:selected').text();
        var breakInDefMEdited = $('select[id=selectBreakInDefMinute] > option:selected').text();
        $('#breakInDef').val(breakInDefYmdEdited + ' ' + breakInDefHEdited + ':' + breakInDefMEdited + ':' + breakInDefS);
    });


    //-------------------------------
    // breakOutDefプルダウン処理

    var breakOutDef = $('#breakOutDef').val();
    var breakOutDefSplit = breakOutDef.split(' ');
    var breakOutDefYmd = breakOutDefSplit[0];
    var breakOutDefHis = breakOutDefSplit[1];
    var breakOutDefHisSplit = breakOutDefHis.split(':');
    var breakOutDefH = breakOutDefHisSplit[0];
    var breakOutDefM = breakOutDefHisSplit[1];
    var breakOutDefS = breakOutDefHisSplit[2];

    var hh,
    $selectBreakOutDefHour = $('#selectBreakOutDefHour'),
    $optionBreakOutDefHours,
    optionsBreakOutDefHours,
    isSelectedBreakOutDefHour;
    optionsBreakOutDefHours = $.map(hh, function(name, value){
            isSelectedBreakOutDefHour = (name === breakOutDefH);
            $optionBreakOutDefHours = $('<option>', {value: value, text: name, selected: isSelectedBreakOutDefHour});
            return $optionBreakOutDefHours;
        });
    $selectBreakOutDefHour.append(optionsBreakOutDefHours);

    var mm,
    $selectBreakOutDefMinute = $('#selectBreakOutDefMinute'),
    $optionBreakOutDefMinutes,
    optionsBreakOutDefMinutes,
    isSelectedBreakOutDefMinute;
    optionsBreakOutDefMinutes = $.map(mm, function(name, value){
            isSelectedBreakOutDefMinute = (name === breakOutDefM);
            $optionBreakOutDefMinutes = $('<option>', {value: value, text: name, selected: isSelectedBreakOutDefMinute});
            return $optionBreakOutDefMinutes;
        });
    $selectBreakOutDefMinute.append(optionsBreakOutDefMinutes);

    $('#breakOutDefYmd').val(breakOutDefYmd);
    $('#breakOutDefYmd').datepicker({
        dateFormat: 'yy-mm-dd',
    });

    $('#createPunchOutBtn').click(function(){
        var breakOutDefYmdEdited = $('#breakOutDefYmd').val();
        var breakOutDefHEdited = $('select[id=selectBreakOutDefHour] > option:selected').text();
        var breakOutDefMEdited = $('select[id=selectBreakOutDefMinute] > option:selected').text();
        $('#breakOutDef').val(breakOutDefYmdEdited + ' ' + breakOutDefHEdited + ':' + breakOutDefMEdited + ':' + breakOutDefS);
    });

});
