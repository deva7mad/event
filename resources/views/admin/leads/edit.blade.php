@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.edit') }} {{ trans('cruds.lead.title_singular') }}
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ route("admin.leads.update", [$lead->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group {{ $errors->has('category') ? 'has-error' : '' }}">
                            <label class="required" for="category_id">{{ trans('cruds.lead.fields.category') }}</label>
                            <select class="form-control select2" name="category_id" id="category_id" required>
                                @foreach($categories as $id => $category)
                                    <option value="{{ $id }}" {{ ($lead->category ? $lead->category->id : old('category_id')) == $id ? 'selected' : '' }}>{{ $category }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('category_id'))
                                <span class="help-block" role="alert">{{ $errors->first('category_id') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.lead.fields.category_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('company_name') ? 'has-error' : '' }}">
                            <label class="required" for="company_name">{{ trans('cruds.lead.fields.company_name') }}</label>
                            <input class="form-control" type="text" name="company_name" id="company_name" value="{{ old('company_name', $lead->company_name) }}" required>
                            @if($errors->has('company_name'))
                                <span class="help-block" role="alert">{{ $errors->first('company_name') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.lead.fields.company_name_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('contact_name') ? 'has-error' : '' }}">
                            <label class="required" for="contact_name">{{ trans('cruds.lead.fields.contact_name') }}</label>
                            <input class="form-control" type="text" name="contact_name" id="contact_name" value="{{ old('contact_name', $lead->contact_name) }}" required>
                            @if($errors->has('contact_name'))
                                <span class="help-block" role="alert">{{ $errors->first('contact_name') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.lead.fields.contact_name_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('contact_number') ? 'has-error' : '' }}">
                            <label class="required" for="contact_number">{{ trans('cruds.lead.fields.contact_number') }}</label>
                            <input class="form-control" type="number" name="contact_number" id="contact_number" value="{{ old('contact_number', $lead->contact_number) }}" step="1" required>
                            @if($errors->has('contact_number'))
                                <span class="help-block" role="alert">{{ $errors->first('contact_number') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.lead.fields.contact_number_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('contact_mail') ? 'has-error' : '' }}">
                            <label class="required" for="contact_mail">{{ trans('cruds.lead.fields.contact_mail') }}</label>
                            <input class="form-control" type="text" name="contact_mail" id="contact_mail" value="{{ old('contact_mail', $lead->contact_mail) }}" required>
                            @if($errors->has('contact_mail'))
                                <span class="help-block" role="alert">{{ $errors->first('contact_mail') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.lead.fields.contact_mail_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('event') ? 'has-error' : '' }}">
                            <label class="required" for="event">{{ trans('cruds.lead.fields.event') }}</label>
                            <input class="form-control" type="text" name="event" id="event" value="{{ old('event', $lead->event) }}" required>
                            @if($errors->has('event'))
                                <span class="help-block" role="alert">{{ $errors->first('event') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.lead.fields.event_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('account_manager') ? 'has-error' : '' }}">
                            <label class="required" for="account_manager">{{ trans('cruds.lead.fields.account_manager') }}</label>
                            <input class="form-control" type="text" name="account_manager" id="account_manager" value="{{ old('account_manager', $lead->account_manager) }}" required>
                            @if($errors->has('account_manager'))
                                <span class="help-block" role="alert">{{ $errors->first('account_manager') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.lead.fields.account_manager_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-danger" type="submit">
                                {{ trans('global.save') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>



        </div>
    </div>
</div>
@endsection