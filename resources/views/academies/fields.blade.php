<!-- Academyid Field -->
<div class="form-group col-sm-12 col-12">
    {!! Form::label('AcademyID', 'Academyid:') !!}
    <p>{!! $academy->AcademyID !!}</p>
    <p><a href="https://app.v1sports.com/{!! $academy->AcademyID !!}" target="_blank">Public Profile</a>
</div>


<!-- Live Field -->
<div class="form-group col-sm-6">
    {!! Form::label('Live', 'Live:') !!}
    <label class="checkbox-inline">
        {!! Form::hidden('Live', 0) !!}
        {!! Form::checkbox('Live', '1', null) !!} 1
    </label>
</div>

<!-- Hiddenflag Field -->
<div class="form-group col-sm-6">
    {!! Form::label('HiddenFlag', 'Hiddenflag:') !!}
    <label class="checkbox-inline">
        {!! Form::hidden('HiddenFlag', 0) !!}
        {!! Form::checkbox('HiddenFlag', '1', null) !!} 1
    </label>
</div>

<!-- Description Field -->
<div class="form-group col-sm-6">
    {!! Form::label('Description', 'Description:') !!}
    {!! Form::text('Description', null, ['class' => 'form-control']) !!}
</div>

<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('Name', 'Name:') !!}
    {!! Form::text('Name', null, ['class' => 'form-control']) !!}
</div>


<!-- Bannertext Field -->
<div class="form-group col-sm-6">
    {!! Form::label('BannerText', 'Bannertext:') !!}
    {!! Form::text('BannerText', null, ['class' => 'form-control']) !!}
</div>

<!-- Sportid Field -->
<div class="form-group col-sm-6">
    {!! Form::label('SportID', 'Sportid:') !!}
    {!! Form::text('SportID', null, ['class' => 'form-control']) !!}
</div>


<!-- Academycountry Field -->
<div class="form-group col-sm-6">
    {!! Form::label('AcademyCountry', 'Academycountry:') !!}
    {!! Form::text('AcademyCountry', null, ['class' => 'form-control']) !!}
</div>

<!-- Logo Field -->
<div class="form-group col-sm-6">
    {!! Form::label('Logo', 'Logo:') !!}
    {!! Form::text('Logo', null, ['class' => 'form-control']) !!}
</div>

<!-- Contractpdf Field -->
<div class="form-group col-sm-6">
    {!! Form::label('ContractPDF', 'Contractpdf:') !!}
    <p>{!! $academy->ContractPDF !!}</p>
</div>




<!-- Basecolor Field -->
<div class="form-group col-sm-6">
    {!! Form::label('BaseColor', 'Basecolor:') !!}
    {!! Form::text('BaseColor', null, ['class' => 'form-control']) !!}
</div>

<!-- Basecolorlt Field -->
<div class="form-group col-sm-6">
    {!! Form::label('BaseColorLt', 'Basecolorlt:') !!}
    {!! Form::text('BaseColorLt', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('academies.index') !!}" class="btn btn-default">Cancel</a>
</div>
