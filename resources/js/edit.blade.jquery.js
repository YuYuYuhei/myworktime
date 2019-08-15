$(function(){

    $('.del').click(function(){
        if(confirm("本当に削除しますか？")){
            //そのままsubmit（削除）
        }else{
            //cancel
            return false;
        }
    });

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



    // --------------------------
    //ex. #punchInプルダウン処理 = 2019-08-10 10:45:28
    var punchIn = $('#punchIn').val();
    var punchInSplit = punchIn.split(' ');
    var punchInYmd = punchInSplit[0];
    var punchInHis = punchInSplit[1];
    var punchInHisSplit = punchInHis.split(':');
    var phnchInH = punchInHisSplit[0];
    var phnchInM = punchInHisSplit[1];
    var phnchInS = punchInHisSplit[2];

    var hh,
    $selectPunchInHour = $('#selectPunchInHour'),
    $optionPunchInHours,
    optionsPunchInHours,
    isSelectedPunchInHour;
    optionsPunchInHours = $.map(hh, function(name, value){
            isSelectedPunchInHour = (name === phnchInH);
            $optionPunchInHours = $('<option>', {value: value, text: name, selected: isSelectedPunchInHour});
            return $optionPunchInHours;
        });
    //
     $selectPunchInHour.append(optionsPunchInHours);

    var mm,
    $selectPunchInMinute = $('#selectPunchInMinute'),
    $optionPunchInMinutes,
    optionsPunchInMinutes,
    isSelectedPunchInMinute;
    optionsPunchInMinutes = $.map(mm, function(name, value){
            isSelectedPunchInMinute = (name === phnchInM);
            $optionPunchInMinutes = $('<option>', {value: value, text: name, selected: isSelectedPunchInMinute});
            return $optionPunchInMinutes;
        });

    $selectPunchInMinute.append(optionsPunchInMinutes);

    $('#punchInYmd').val(punchInYmd);
    $('#punchInYmd').datepicker({
        dateFormat: 'yy-mm-dd',
    });

    $('#editBtn').click(function(){
        var punchInYmdEdited = $('#punchInYmd').val();
        var punchInHEdited = $('select[id=selectPunchInHour] > option:selected').text();
        var punchInMEdited = $('select[id=selectPunchInMinute] > option:selected').text();
        $('#punchIn').val(punchInYmdEdited + ' ' + punchInHEdited + ':' + punchInMEdited + ':' + phnchInS);
    });


    //-------------------------------
    // punchOutプルダウン処理

    var punchOut = $('#punchOut').val();
    var punchOutSplit = punchOut.split(' ');
    var punchOutYmd = punchOutSplit[0];
    var punchOutHis = punchOutSplit[1];
    var punchOutHisSplit = punchOutHis.split(':');
    var phnchOutH = punchOutHisSplit[0];
    var phnchOutM = punchOutHisSplit[1];
    var phnchOutS = punchOutHisSplit[2];

    var hh,
    $selectPunchOutHour = $('#selectPunchOutHour'),
    $optionPunchOutHours,
    optionsPunchOutHours,
    isSelectedPunchOutHour;
    optionsPunchOutHours = $.map(hh, function(name, value){
            isSelectedPunchOutHour = (name === phnchOutH);
            $optionPunchOutHours = $('<option>', {value: value, text: name, selected: isSelectedPunchOutHour});
            return $optionPunchOutHours;
        });
    $selectPunchOutHour.append(optionsPunchOutHours);

    var mm,
    $selectPunchOutMinute = $('#selectPunchOutMinute'),
    $optionPunchOutMinutes,
    optionsPunchOutMinutes,
    isSelectedPunchOutMinute;
    optionsPunchOutMinutes = $.map(mm, function(name, value){
            isSelectedPunchOutMinute = (name === phnchOutM);
            $optionPunchOutMinutes = $('<option>', {value: value, text: name, selected: isSelectedPunchOutMinute});
            return $optionPunchOutMinutes;
        });
    $selectPunchOutMinute.append(optionsPunchOutMinutes);

    $('#punchOutYmd').val(punchOutYmd);
    $('#punchOutYmd').datepicker({
        dateFormat: 'yy-mm-dd',
    });

    $('#editBtn').click(function(){
        var punchOutYmdEdited = $('#punchOutYmd').val();
        var punchOutHEdited = $('select[id=selectPunchOutHour] > option:selected').text();
        var punchOutMEdited = $('select[id=selectPunchOutMinute] > option:selected').text();
        $('#punchOut').val(punchOutYmdEdited + ' ' + punchOutHEdited + ':' + punchOutMEdited + ':' + phnchOutS);
    });


    //-------------------------------
    // breakInプルダウン処理

    var breakIn = $('#breakIn').val();
    var breakInSplit = breakIn.split(' ');
    var breakInYmd = breakInSplit[0];
    var breakInHis = breakInSplit[1];
    var breakInHisSplit = breakInHis.split(':');
    var breakInH = breakInHisSplit[0];
    var breakInM = breakInHisSplit[1];
    var breakInS = breakInHisSplit[2];

    var hh,
    $selectBreakInHour = $('#selectBreakInHour'),
    $optionBreakInHours,
    optionsBreakInHours,
    isSelectedBreakInHour;
    optionsBreakInHours = $.map(hh, function(name, value){
            isSelectedBreakInHour = (name === breakInH);
            $optionBreakInHours = $('<option>', {value: value, text: name, selected: isSelectedBreakInHour});
            return $optionBreakInHours;
        });
    $selectBreakInHour.append(optionsBreakInHours);

    var mm,
    $selectBreakInMinute = $('#selectBreakInMinute'),
    $optionBreakInMinutes,
    optionsBreakInMinutes,
    isSelectedBreakInMinute;
    optionsBreakInMinutes = $.map(mm, function(name, value){
            isSelectedBreakInMinute = (name === breakInM);
            $optionBreakInMinutes = $('<option>', {value: value, text: name, selected: isSelectedBreakInMinute});
            return $optionBreakInMinutes;
        });
    $selectBreakInMinute.append(optionsBreakInMinutes);

    $('#breakInYmd').val(breakInYmd);
    $('#breakInYmd').datepicker({
        dateFormat: 'yy-mm-dd',
    });

    $('#editBtn').click(function(){
        var breakInYmdEdited = $('#breakInYmd').val();
        var breakInHEdited = $('select[id=selectBreakInHour] > option:selected').text();
        var breakInMEdited = $('select[id=selectBreakInMinute] > option:selected').text();
        $('#breakIn').val(breakInYmdEdited + ' ' + breakInHEdited + ':' + breakInMEdited + ':' + breakInS);
    });


    //-------------------------------
    // breakOutプルダウン処理

    var breakOut = $('#breakOut').val();
    var breakOutSplit = breakOut.split(' ');
    var breakOutYmd = breakOutSplit[0];
    var breakOutHis = breakOutSplit[1];
    var breakOutHisSplit = breakOutHis.split(':');
    var breakOutH = breakOutHisSplit[0];
    var breakOutM = breakOutHisSplit[1];
    var breakOutS = breakOutHisSplit[2];

    var hh,
    $selectBreakOutHour = $('#selectBreakOutHour'),
    $optionBreakOutHours,
    optionsBreakOutHours,
    isSelectedBreakOutHour;
    optionsBreakOutHours = $.map(hh, function(name, value){
            isSelectedBreakOutHour = (name === breakOutH);
            $optionBreakOutHours = $('<option>', {value: value, text: name, selected: isSelectedBreakOutHour});
            return $optionBreakOutHours;
        });
    $selectBreakOutHour.append(optionsBreakOutHours);

    var mm,
    $selectBreakOutMinute = $('#selectBreakOutMinute'),
    $optionBreakOutMinutes,
    optionsBreakOutMinutes,
    isSelectedBreakOutMinute;
    optionsBreakOutMinutes = $.map(mm, function(name, value){
            isSelectedBreakOutMinute = (name === breakOutM);
            $optionBreakOutMinutes = $('<option>', {value: value, text: name, selected: isSelectedBreakOutMinute});
            return $optionBreakOutMinutes;
        });
    $selectBreakOutMinute.append(optionsBreakOutMinutes);

    $('#breakOutYmd').val(breakOutYmd);
    $('#breakOutYmd').datepicker({
        dateFormat: 'yy-mm-dd',
    });

    $('#editBtn').click(function(){
        var breakOutYmdEdited = $('#breakOutYmd').val();
        var breakOutHEdited = $('select[id=selectBreakOutHour] > option:selected').text();
        var breakOutMEdited = $('select[id=selectBreakOutMinute] > option:selected').text();
        $('#breakOut').val(breakOutYmdEdited + ' ' + breakOutHEdited + ':' + breakOutMEdited + ':' + breakOutS);
    });

});
