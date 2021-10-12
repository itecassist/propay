<div class="row mb-3">
    <div class="col-sm-6">
        <label class="form-label">{{ __('candidates.fields.name') }}</label>
        <input type="text" class="form-control form-control-sm" name="name" required value="{{ (isset($candidate)) ? $candidate->name : old('name') }}">
        <div class="invalid-feedback">
            {{ __('candidates.error.name') }}
        </div>
    </div>
    <div class="col-sm-6">
        <label class="form-label">{{ __('candidates.fields.surname') }}</label>
        <input type="text" class="form-control form-control-sm" name="surname" required value="{{ (isset($candidate)) ? $candidate->surname : old('surname') }}">
    </div>
    <div class="col-sm-6 mt-2">
        <label class="form-label">{{ __('candidates.fields.email') }}</label>
        <input type="text" class="form-control form-control-sm" name="email" required value="{{ (isset($candidate)) ? $candidate->email : old('email') }}">
    </div>
    <div class="col-sm-6 mt-2">
        <label class="form-label">{{ __('candidates.fields.sa_id') }}</label>
        <input type="text" class="form-control form-control-sm" name="sa_id" id="sa_id" required value="{{ (isset($candidate)) ? $candidate->sa_id : old('sa_id') }}" onkeyup="checkID()">
        <div class="text-danger"><small id="id_results"></small></div>
    </div>
    <div class="col-sm-4 mt-2">
        <label class="form-label">{{ __('candidates.fields.mobile_number') }}</label>
        <input type="text" class="form-control form-control-sm" name="mobile_number" required value="{{ (isset($candidate)) ? $candidate->mobile_number : old('mobile_number') }}">
    </div>

    <div class="col-sm-4 mt-2">
        <label class="form-label">{{ __('candidates.fields.language') }}</label>
        <select class="form-select form-select-sm" name="language" required>
            <option value="">{{ __('global.pleaseSelect') }}</option>
            @foreach (__('languages') as $k => $v)
                <option value="{{ $k }}" @if(isset($candidate) && $candidate->language==$k) selected @endif>{{ $v }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-sm-4 mt-2">
        <label class="form-label">{{ __('candidates.fields.date_of_birth') }}</label>
        <input type="date" class="form-control form-control-sm" name="date_of_birth" id="date_of_birth" required value="{{ (isset($candidate)) ? $candidate->date_of_birth : old('date_of_birth') }}">
    </div>

</div>
<div class="col-sm-12 mt-2">
    <label class="form-label">{{ __('candidates.fields.interests') }}</label>
    <div class="row">
        @foreach (__('candidates.interests') as $k => $v)
        @php
        if(isset($candidate)){
            $interests = explode(',', $candidate->interests);
        }
        @endphp
            <div class="col-sm-4 mb-2">
                <div class="form-check">
                    <input class="form-check-input" name="interests[]" type="checkbox" value="{{ $k }}" id="int_{{ $k }}" @if(isset($candidate) && in_array($k, $interests)) checked @endif>
                    <label class="form-check-label" for="int_{{ $k }}">
                        {{ $v }}
                    </label>
                </div>
            </div>
        @endforeach
    </div>
</div>
<div class="row">
    <div class="text-end">
        <button type="submit" class="btn btn-primary btn-sm">{{ __('global.save') }}</button>
    </div>
</div>
@section('scripts')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        flatpickr("#date_of_birth", {});
        function ValidateID(id_number) {
            var sectionTestsSuccessFull = 1;
            var MessageCodeArray = [];
            var MessageDescriptionArray = [];
            var currentTime = new Date();

            /* DO ID LENGTH TEST */
            if (id_number.length == 13) {
                /* SPLIT ID INTO SECTIONS */
                var year = id_number.substr(0, 2);
                var month = id_number.substr(2, 2);
                var day = id_number.substr(4, 2);
                var gender = (id_number.substr(6, 4) * 1);
                var citizen = (id_number.substr(10, 2) * 1);
                var check_sum = (id_number.substr(12, 1) * 1);
                var dob = '';
                /* DO YEAR TEST */
                var nowYearNotCentury = currentTime.getFullYear() + '';
                nowYearNotCentury = nowYearNotCentury.substr(2, 2);
                if (year <= nowYearNotCentury) {
                    year = '20' + year;
                } else {
                    year = '19' + year;
                } //end if
                if ((year > 1900) && (year < currentTime.getFullYear())) {
                    dob += year + '-';
                } else {
                    sectionTestsSuccessFull = 0;
                    MessageCodeArray[MessageCodeArray.length] = 1;
                    MessageDescriptionArray[MessageDescriptionArray.length] = '{{ __('id.year') }}';
                } //end if

                /* DO MONTH TEST */
                if ((month > 0) && (month < 13)) {
                    dob += month + '-';
                } else {
                    sectionTestsSuccessFull = 0;
                    MessageCodeArray[MessageCodeArray.length] = 2;
                    MessageDescriptionArray[MessageDescriptionArray.length] = '{{ __('id.month') }}';
                } //end if

                /* DO DAY TEST */
                if ((day > 0) && (day < 32)) {
                    dob += day;
                    $('#date_of_birth').val(dob);
                } else {
                    sectionTestsSuccessFull = 0;
                    MessageCodeArray[MessageCodeArray.length] = 3;
                    MessageDescriptionArray[MessageDescriptionArray.length] = '{{ __('id.day') }}';
                } //end if

                /* DO DATE TEST */
                if ((month == 4 || month == 6 || month == 9 || month == 11) && day == 31) {
                    sectionTestsSuccessFull = 0;
                    MessageCodeArray[MessageCodeArray.length] = 4;
                    MessageDescriptionArray[MessageDescriptionArray.length] = '{{ __('id.month_day') }}';
                }
                if (month == 2) { // check for february 29th
                    var isleap = (year % 4 == 0 && (year % 100 != 0 || year % 400 == 0));
                    if (day > 29 || (day == 29 && !isleap)) {
                        sectionTestsSuccessFull = 0;
                        MessageCodeArray[MessageCodeArray.length] = 5;
                        MessageDescriptionArray[MessageDescriptionArray.length] = '{{ __('id.february') }}' + day +
                            '  ' + year + '{{ __('id.days_of_year') }}';
                    } //end if
                } //end if

                /* DO GENDER TEST */
                if ((gender >= 0) && (gender < 10000)) {

                    if (gender > 5000) {
                        $('#gender').val(1)
                    } else {
                        $('#gender').val(0)
                    }
                } else {
                    sectionTestsSuccessFull = 0;
                    MessageCodeArray[MessageCodeArray.length] = 6;
                    MessageDescriptionArray[MessageDescriptionArray.length] = '{{ __('id.gender') }}';
                } //end if

                /* DO CITIZEN TEST */
                //08 or 09 SA citizen
                //18 or 19 Not SA citizen but with residence permit
                if ((citizen == 8) || (citizen == 9) || (citizen == 18) || (citizen == 19)) {
                    //correct
                } else {
                    sectionTestsSuccessFull = 0;
                    MessageCodeArray[MessageCodeArray.length] = 7;
                    MessageDescriptionArray[MessageDescriptionArray.length] = '{{ __('id.citizen') }}';
                } //end if

                /* GET CHECKSUM VALUE */
                var check_sum_odd = 0;
                var check_sum_even = 0;
                var check_sum_even_temp = "";
                var check_sum_value = 0;
                var count = 0;
                // Get ODD Value
                for (count = 0; count < 11; count += 2) {
                    check_sum_odd += (id_number.substr(count, 1) * 1);
                } //end for
                // Get EVEN Value
                for (count = 0; count < 12; count += 2) {
                    check_sum_even_temp = check_sum_even_temp + (id_number.substr(count + 1, 1)) + '';
                } //end for
                check_sum_even_temp = check_sum_even_temp * 2;
                check_sum_even_temp = check_sum_even_temp + '';
                for (count = 0; count < check_sum_even_temp.length; count++) {
                    check_sum_even += (check_sum_even_temp.substr(count, 1)) * 1;
                } //end for
                // GET Checksum Value
                check_sum_value = (check_sum_odd * 1) + (check_sum_even * 1);
                check_sum_value = check_sum_value + 'xxx';
                check_sum_value = (10 - (check_sum_value.substr(1, 1) * 1));
                if (check_sum_value == 10)
                    check_sum_value = 0;

                /* DO CHECKSUM TEST */
                if (check_sum_value == check_sum) {
                    //correct
                } else {
                    sectionTestsSuccessFull = 0;
                    MessageCodeArray[MessageCodeArray.length] = 8;
                    MessageDescriptionArray[MessageDescriptionArray.length] = '{{ __('id.checksum') }}';
                } //end if

            } else {
                sectionTestsSuccessFull = 0;
                MessageCodeArray[MessageCodeArray.length] = 0;
                MessageDescriptionArray[MessageDescriptionArray.length] = '{{ __('id.idno') }}';
            } //end if

            if (sectionTestsSuccessFull === 0) {
                return MessageDescriptionArray;
            } else {
                return true;
            }
        }
        var submitForm = false;
        $('#candidateForm').on('submit', function() {
            submitForm = checkID();

            if(submitForm === true){
                $.ajax({
                    @if (isset($candidate))
                    url: "{{ route('candidates.update', $candidate->id) }}",
                    @else
                    url: "{{ route('candidates.store') }}",
                    @endif

                    method:'POST',
                    data: new FormData(this),
                    processData:false,
                    contentType: false,
                    cache: false,
                    dataType: 'JSON',
                    success: function(response)
                    {
                        if(response.success){
                        notice('success', '{{__('global.record_created')}}');
                        window.location.href="{{ route('candidates.index') }}";
                    }else{
                        let err='<ul class="text-start">';
                        for(let i=0; i<response.length; i++)
                        {
                            err += "<li>"+response[i]+"</li>";
                        }
                        err +="</ul>";
                        notice('error', '{{__('global.error_update')}}', err);
                    }
                    }
                });
            }
            return false;

        });

        function checkID(){
            $('#sa_id').removeClass('is-valid is-invalid')
            $('#id_results').html('');
            var validate = ValidateID($('#sa_id').val());

            if (validate === true) {
                $('#sa_id').addClass('is-valid');
                return true;
            } else {
                $('#sa_id').addClass('is-invalid');
                $('#id_results').html(validate);
                return false;
            }
        }
    </script>
@endsection
