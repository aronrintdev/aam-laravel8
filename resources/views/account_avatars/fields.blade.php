<!-- Avatarurl Field -->
<div class="form-group col-sm-6">
    {!! Form::label('AvatarURL', 'Avatarurl:') !!}
    {!! Form::text('AvatarURL', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('accountAvatars.index') !!}" class="btn btn-default">Cancel</a>
</div>
