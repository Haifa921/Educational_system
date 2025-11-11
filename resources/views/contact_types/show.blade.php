@extends('layouts.master')
@section('title', ' عرض جهة الاتصال')

@section('content')
<hr>
<div class="row">
    <div class="col-md-10 mx-auto">
        <div class="card">
            <div class="card-header">
                <h2>Contact Type Details</h2>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <strong>ID:</strong>
                            <p>{{ $contactType->id }}</p>
                        </div>
                        <div class="mb-3">
                            <strong>Type Value:</strong>
                            <p>{{ $contactType->type_value }}</p>
                        </div>
                        <div class="mb-3">
                            <strong>Note:</strong>
                            <p>{{ $contactType->note ?? 'N/A' }}</p>
                        </div>
                        <div class="mb-3">
                            <strong>Total Contacts:</strong>
                            <p><span class="badge bg-info">{{ $contactsCount }}</span></p>
                        </div>
                    </div>
                </div>

                @if($contactsCount > 0)
                <div class="mt-4">
                    <h5>Associated Contacts</h5>
                    <div class="table-responsive">
                        <table class="table table-sm table-striped">
                            <thead>
                                <tr>
                                    <th>Employee</th>
                                    <th>Contact Value</th>
                                    <th>Note</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($contactType->contacts as $contact)
                                <tr>
                                    <td>{{ $contact->employee->name ?? 'N/A' }}</td>
                                    <td>{{ $contact->contact_value }}</td>
                                    <td>{{ Str::limit($contact->note, 30) ?? 'N/A' }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                @else
                <div class="mt-4">
                    <div class="alert alert-info">
                        No contacts associated with this contact type.
                    </div>
                </div>
                @endif

                <div class="mt-4">
                    <a href="{{ route('contact-types.edit', $contactType) }}" class="btn btn-warning">Edit</a>
                    <a href="{{ route('contact-types.index') }}" class="btn btn-secondary">Back to List</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection