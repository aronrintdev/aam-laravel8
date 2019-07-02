<!-- Lesslogid Field -->
<div class="form-group col-sm-6">
    {!! Form::label('LessLogID', 'Lesslogid:') !!}
    {!! Form::text('LessLogID', null, ['class' => 'form-control']) !!}
</div>

<!-- Academyid Field -->
<div class="form-group col-sm-6">
    {!! Form::label('AcademyID', 'Academyid:') !!}
    {!! Form::text('AcademyID', null, ['class' => 'form-control']) !!}
</div>

<!-- Billerror Field -->
<div class="form-group col-sm-6">
    {!! Form::label('BillError', 'Billerror:') !!}
    {!! Form::text('BillError', null, ['class' => 'form-control']) !!}
</div>

<!-- Instructorid Field -->
<div class="form-group col-sm-6">
    {!! Form::label('InstructorID', 'Instructorid:') !!}
    {!! Form::text('InstructorID', null, ['class' => 'form-control']) !!}
</div>

<!-- Description U Field -->
<div class="form-group col-sm-6">
    {!! Form::label('Description_U', 'Description U:') !!}
    {!! Form::text('Description_U', null, ['class' => 'form-control']) !!}
</div>

<!-- Lastviewbyinstructor Field -->
<div class="form-group col-sm-6">
    {!! Form::label('LastViewByInstructor', 'Lastviewbyinstructor:') !!}
    <label class="checkbox-inline">
        {!! Form::hidden('LastViewByInstructor', 0) !!}
        {!! Form::checkbox('LastViewByInstructor', '1', null) !!} 1
    </label>
</div>

<!-- Dateanalyzed Field -->
<div class="form-group col-sm-6">
    {!! Form::label('DateAnalyzed', 'Dateanalyzed:') !!}
    {!! Form::date('DateAnalyzed', null, ['class' => 'form-control','id'=>'DateAnalyzed']) !!}
</div>

@section('scripts')
    <script type="text/javascript">
        $('#DateAnalyzed').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: false
        })
    </script>
@endsection

<!-- Procharge Field -->
<div class="form-group col-sm-6">
    {!! Form::label('ProCharge', 'Procharge:') !!}
    {!! Form::text('ProCharge', null, ['class' => 'form-control']) !!}
</div>

<!-- Rating Field -->
<div class="form-group col-sm-6">
    {!! Form::label('Rating', 'Rating:') !!}
    {!! Form::text('Rating', null, ['class' => 'form-control']) !!}
</div>

<!-- Swingstatusid Field -->
<div class="form-group col-sm-6">
    {!! Form::label('SwingStatusID', 'Swingstatusid:') !!}
    {!! Form::text('SwingStatusID', null, ['class' => 'form-control']) !!}
</div>

<!-- Daterated Field -->
<div class="form-group col-sm-6">
    {!! Form::label('DateRated', 'Daterated:') !!}
    {!! Form::date('DateRated', null, ['class' => 'form-control','id'=>'DateRated']) !!}
</div>

@section('scripts')
    <script type="text/javascript">
        $('#DateRated').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: false
        })
    </script>
@endsection

<!-- Dateuploaded Field -->
<div class="form-group col-sm-6">
    {!! Form::label('DateUploaded', 'Dateuploaded:') !!}
    {!! Form::date('DateUploaded', null, ['class' => 'form-control','id'=>'DateUploaded']) !!}
</div>

@section('scripts')
    <script type="text/javascript">
        $('#DateUploaded').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: false
        })
    </script>
@endsection

<!-- Description Field -->
<div class="form-group col-sm-6">
    {!! Form::label('Description', 'Description:') !!}
    {!! Form::text('Description', null, ['class' => 'form-control']) !!}
</div>

<!-- Paid Field -->
<div class="form-group col-sm-6">
    {!! Form::label('Paid', 'Paid:') !!}
    <label class="checkbox-inline">
        {!! Form::hidden('Paid', 0) !!}
        {!! Form::checkbox('Paid', '1', null) !!} 1
    </label>
</div>

<!-- Ccswingid Field -->
<div class="form-group col-sm-6">
    {!! Form::label('CCSwingID', 'Ccswingid:') !!}
    {!! Form::text('CCSwingID', null, ['class' => 'form-control']) !!}
</div>

<!-- Videopath Field -->
<div class="form-group col-sm-6">
    {!! Form::label('VideoPath', 'Videopath:') !!}
    {!! Form::text('VideoPath', null, ['class' => 'form-control']) !!}
</div>

<!-- Vimeoid Field -->
<div class="form-group col-sm-6">
    {!! Form::label('VimeoID', 'Vimeoid:') !!}
    {!! Form::text('VimeoID', null, ['class' => 'form-control']) !!}
</div>

<!-- Billed Field -->
<div class="form-group col-sm-6">
    {!! Form::label('Billed', 'Billed:') !!}
    <label class="checkbox-inline">
        {!! Form::hidden('Billed', 0) !!}
        {!! Form::checkbox('Billed', '1', null) !!} 1
    </label>
</div>

<!-- Deleted Field -->
<div class="form-group col-sm-6">
    {!! Form::label('Deleted', 'Deleted:') !!}
    <label class="checkbox-inline">
        {!! Form::hidden('Deleted', 0) !!}
        {!! Form::checkbox('Deleted', '1', null) !!} 1
    </label>
</div>

<!-- Accountid Field -->
<div class="form-group col-sm-6">
    {!! Form::label('AccountID', 'Accountid:') !!}
    {!! Form::text('AccountID', null, ['class' => 'form-control']) !!}
</div>

<!-- Socialq Field -->
<div class="form-group col-sm-6">
    {!! Form::label('SocialQ', 'Socialq:') !!}
    {!! Form::text('SocialQ', null, ['class' => 'form-control']) !!}
</div>

<!-- Proinvoice Field -->
<div class="form-group col-sm-6">
    {!! Form::label('ProInvoice', 'Proinvoice:') !!}
    {!! Form::text('ProInvoice', null, ['class' => 'form-control']) !!}
</div>

<!-- Dateaccepted Field -->
<div class="form-group col-sm-6">
    {!! Form::label('DateAccepted', 'Dateaccepted:') !!}
    {!! Form::date('DateAccepted', null, ['class' => 'form-control','id'=>'DateAccepted']) !!}
</div>

@section('scripts')
    <script type="text/javascript">
        $('#DateAccepted').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: false
        })
    </script>
@endsection

<!-- Charge Field -->
<div class="form-group col-sm-6">
    {!! Form::label('Charge', 'Charge:') !!}
    {!! Form::text('Charge', null, ['class' => 'form-control']) !!}
</div>

<!-- Sportid Field -->
<div class="form-group col-sm-6">
    {!! Form::label('SportID', 'Sportid:') !!}
    {!! Form::text('SportID', null, ['class' => 'form-control']) !!}
</div>

<!-- Billdate Field -->
<div class="form-group col-sm-6">
    {!! Form::label('BillDate', 'Billdate:') !!}
    {!! Form::date('BillDate', null, ['class' => 'form-control','id'=>'BillDate']) !!}
</div>

@section('scripts')
    <script type="text/javascript">
        $('#BillDate').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: false
        })
    </script>
@endsection

<!-- Analysispath Field -->
<div class="form-group col-sm-6">
    {!! Form::label('AnalysisPath', 'Analysispath:') !!}
    {!! Form::text('AnalysisPath', null, ['class' => 'form-control']) !!}
</div>

<!-- Lastviewed Field -->
<div class="form-group col-sm-6">
    {!! Form::label('LastViewed', 'Lastviewed:') !!}
    {!! Form::date('LastViewed', null, ['class' => 'form-control','id'=>'LastViewed']) !!}
</div>

@section('scripts')
    <script type="text/javascript">
        $('#LastViewed').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: false
        })
    </script>
@endsection

<!-- Ratingip Field -->
<div class="form-group col-sm-6">
    {!! Form::label('RatingIP', 'Ratingip:') !!}
    {!! Form::text('RatingIP', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('swings.index') !!}" class="btn btn-default">Cancel</a>
</div>
