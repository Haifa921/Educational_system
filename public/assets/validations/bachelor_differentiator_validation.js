$(document).ready(function() {
    const desire = document.querySelector('#desire_id');
    const is_university = document.querySelector('#is_university');
    const high_school_average = document.querySelector('#high_school_average');
    const acceptance_exam = document.querySelector('#acceptance_exam_div');
    const mark = document.querySelector('#mark');
    const average = document.querySelector('#average');

    // Event listeners for each dropdown
    $('#university_average').change(function() {
        calculate_average();
    });

    $('#high_school_average').change(function() {
        calculate_average();
    });

    $('#high_school_type').change(function() {
        getMarkAverage(mark, average);
        checkMark(mark);
        calculate_average();

    });


    //calcaulate average
    function calculate_average() {
        const university_average = $('#university_average').val();
        const high_school_average_value = high_school_average.value;

        const is_university_value = is_university.value;

        const parse_university_average = parseFloat(university_average);
        const parse_high_school_average_value = parseFloat(high_school_average_value);

        if(is_university_value == 1)
        {
            // Calculate the average
            const average_value = (parse_university_average + parse_high_school_average_value) / 2;
        
            // Explicitly round to two decimal places
            const rounded_average = Math.round(average_value * 100) / 100; // Round to nearest hundredth
        
            // Format it as a string with two decimal places
            const formatted_average = rounded_average.toFixed(2);
        
            // Set the value in the average input field
            let average = $('#average'); // This references the jQuery object
            average.val(formatted_average); // Set the value using jQuery
        
            // Optionally call get_specializations(rounded_average) if necessary

            //get_specializations(average_value);

        }
        else
        {
        average_value = parse_university_average;

            let average = $('#average'); // This references the jQuery object
            average.val(average_value); // Set the value using jQuery

           // get_specializations(average_value);
        }
    }

    function get_specializations(average_value) {

        const average = average_value;
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
                        jQuery('select[name="desire_id"]').empty();
                        $('select[name="desire_id"]').append(
                            '<option>الرجاء الاختيار</option>');
                        jQuery.each(data, function(key, value) {

                            $('select[name="desire_id"]').append(
                                '<option value="' + key + '">' + value +
                                '</option>');
                        });
                    } else
                        jQuery('select[name="desire_id"]').empty();
                }
            });
        } else {
            $('select[name="desire_id"]').empty();
        }
    }

    // Event listeners for each dropdown
     $('#desire_id').change(function() {
        checkDesire(desire, acceptance_exam);
    });

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

    $('#mark').change(function() {
        checkMark(mark);
        getMarkAverage(mark, average);
    });

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
        const high_school_type_value = document.querySelector('#high_school_type').value;

       /// alert(high_school_type_value)
         if (mark) {
            $.ajax({
                url: markPercentageUrl, // Adjust this route for different desires if necessary
                method: "GET",
                data: {
                    high_school_type: high_school_type_value,
                    mark: mark_value
                },
                success: function(markPercentage) {
                    high_school_average.value = markPercentage;
                },
            });
        }
    }
});
