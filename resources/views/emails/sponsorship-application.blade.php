<!DOCTYPE html>
<html>
<head>
    <title>New Sponsorship Application</title>
</head>
<body>
    <h2>New Application Received</h2>
    <p><strong>Type:</strong> {{ $application->type === 'sponsor' ? 'Sponsor (Organisation)' : 'Student' }}</p>
    <p><strong>Name:</strong> {{ $application->name }}</p>
    <p><strong>Email:</strong> {{ $application->email }}</p>
    <p><strong>Phone:</strong> {{ $application->phone }}</p>

    @if($application->type === 'sponsor')
        <p><strong>Number of students to sponsor:</strong> {{ $application->student_count }}</p>
    @else
        <p><strong>Essay:</strong></p>
        <p>{{ $application->essay }}</p>
    @endif

    <p><strong>Consent given:</strong> {{ $application->consent ? 'Yes' : 'No' }}</p>
    <p><strong>Status:</strong> {{ $application->status }}</p>
    <p><small>Submitted at: {{ $application->created_at }}</small></p>
</body>
</html>