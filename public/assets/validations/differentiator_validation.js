$(document).ready(function() {

    
    const mark = document.querySelector('#mark');
    const average = document.querySelector('#average');
    const student_number = document.querySelector('#student_number_block');
    const governorate_id = document.querySelector('#governorate_id_block');
    const certificate_origin_id = document.querySelector('#certificate_origin_id');
    const differential_type_id = document.querySelector('#differential_type_id');

    $('#mark').change(function() {
        checkMark(mark);
        getMarkAverage(mark, average);
    });

    $('#high_school_type').change(function() {
        getMarkAverage(mark, average);
        checkMark(mark);
    });

    $('#differential_type_id').change(function() {
        if (differential_type_id.value != '1') {
            governorate_id.style.display = 'none';
            student_number.style.display = 'none';
        } else {
            governorate_id.style.display = 'block';
            student_number.style.display = 'block';
        }

    });

    $('#certificate_origin_id').change(function() {
        if (certificate_origin_id.value != '1') {
            governorate_id.style.display = 'none';
            student_number.style.display = 'none';
        } else {
            governorate_id.style.display = 'block';
            student_number.style.display = 'block';
        }

    });

    const first_desire = document.querySelector('#first_desire_id');
    const second_desire = document.querySelector('#second_desire_id');
    const third_desire = document.querySelector('#third_desire_id');

    const first_acceptance_exam = document.querySelector('#first_acceptance_exam_div');
    const second_acceptance_exam = document.querySelector('#second_acceptance_exam_div');
    const third_acceptance_exam = document.querySelector('#third_acceptance_exam_div');

    // Event listeners for each dropdown
    $('#first_desire_id').change(function() {
        checkDesire(first_desire, first_acceptance_exam);
        getspecializarions(first_desire);
    });

    $('#second_desire_id').change(function() {
        checkDesire(second_desire, second_acceptance_exam);
        getspecializarions_third(first_desire, second_desire);
    });

    $('#third_desire_id').change(function() {
        checkDesire(third_desire, third_acceptance_exam);
    });

    function get_firstspecializarions(average_value) {

        const average = $(average_value).val();
        const high_school_type = document.querySelector('#high_school_type').value;

        if (average) {
            $.ajax({
                url: getSpecializationsUrl,
                type: "GET",
                dataType: "json",
                data: {
                    high_school_type: high_school_type,
                    average: average,
                },
                success: function(data) {
                    console.log(data);
                    if (data) {
                        jQuery('select[name="first_desire_id"]').empty();
                        $('select[name="first_desire_id"]').append(
                            '<option disabled>الرجاء الاختيار</option>');
                        jQuery.each(data, function(key, value) {

                            $('select[name="first_desire_id"]').append(
                                '<option value="' + key + '">' + value +
                                '</option>');
                        });
                    } else
                        jQuery('select[name="first_desire_id"]').empty();
                }
            });
        } else {
            $('select[name="first_desire_id"]').empty();
        }
    }
    //});

    //Get specialization based on conditions
    //For second desire
    function getspecializarions(desireId) {

        const first_desire = $(desireId).val();
        const high_school_type = document.querySelector('#high_school_type').value;
        const average = document.querySelector('#average').value;

        if (first_desire) {
            $.ajax({
                url: getSpecializationsSecondUrl,
                type: "GET",
                dataType: "json",
                data: {
                    high_school_type: high_school_type,
                    average: average,
                    first_desire: first_desire,
                },
                success: function(data) {
                    console.log(data);
                    if (data) {
                        jQuery('select[name="second_desire_id"]').empty();
                        $('select[name="second_desire_id"]').append(
                            '<option>الرجاء الاختيار</option>');
                        jQuery.each(data, function(key, value) {

                            $('select[name="second_desire_id"]').append(
                                '<option value="' + key + '">' + value +
                                '</option>');
                        });
                    } else
                        jQuery('select[name="second_desire_id"]').empty();
                }
            });
        } else {
            $('select[name="second_desire_id"]').empty();
        }
    }

    //Get specialization based on conditions
    //For second desire
    function getspecializarions_third(desireFirst, desireSecond) {

        const first_desire = $(desireFirst).val();
        const second_desire = $(desireSecond).val();
        const high_school_type = document.querySelector('#high_school_type').value;
        const average = document.querySelector('#average').value;

        if (first_desire) {
            $.ajax({
                url: getSpecializationsthirdUrl,
                type: "GET",
                dataType: "json",
                data: {
                    high_school_type: high_school_type,
                    average: average,
                    first_desire: first_desire,
                    second_desire: second_desire,
                },
                success: function(data) {
                    console.log(data);
                    if (data) {
                        jQuery('select[name="third_desire_id"]').empty();
                        $('select[name="third_desire_id"]').append(
                            '<option>الرجاء الاختيار</option>');
                        jQuery.each(data, function(key, value) {

                            $('select[name="third_desire_id"]').append(
                                '<option value="' + key + '">' + value +
                                '</option>');
                        });
                    } else
                        jQuery('select[name="third_desire_id"]').empty();
                }
            });
        } else {
            $('select[name="third_desire_id"]').empty();
        }
    }


    // Function to check desire and show/hide acceptance exam input
    function checkDesire(desireId, examDivId) {

        const desireValue = $(desireId).val();
        if (desireValue) {
            $.ajax({
                url: checkDesireUrl, // Adjust this route for different desires if necessary
                method: "GET",
                data: {
                    desire: desireValue
                },
                success: function(requires_exam) {
                    if (requires_exam == '1') {
                        examDivId.style.display = 'block';
                    } else {
                        examDivId.style.display = 'none';
                    }
                },

            });
        } else {
            $(examDivId).hide();
        }
    }

    function checkMark(mark) {

        const mark_value = $(mark).val();
        const high_school_type = document.querySelector('#high_school_type').value;

        if (mark) {
            $.ajax({
                url: checkMarkUrl, // Adjust this route for different desires if necessary
                method: "GET",
                data: {
                    high_school_type: high_school_type,
                    mark: mark_value
                },
                success: function(markResult) {
                    if (markResult == '0') {
                        alert('قيمة المعدل خاطئ أكبر من الحد الأعلى أو أدنى من الحد الأدنى');
                    }
                },
                error: function(xhr, status, error) {
                    console.log('Error:', error);
                }
            });
        }
    }

    function getMarkAverage(mark, average) {

        const mark_value = $(mark).val();
        const average_value = $(average);
        const high_school_type = document.querySelector('#high_school_type').value;
        if (mark) {
            $.ajax({
                url: markPercentageUrl, // Adjust this route for different desires if necessary
                method: "GET",
                data: {
                    high_school_type: high_school_type,
                    mark: mark_value
                    //average: average
                },
                success: function(markPercentage) {
                    average.value = markPercentage;
                    get_firstspecializarions(average_value);
                },
            });
        }
    }
});
