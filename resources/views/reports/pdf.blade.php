<!DOCTYPE html>
<html>
<head><title>Blood Report</title></head>
<body>
    <h2>Blood Donation Report</h2>
    <p>Date Generated: {{ $date }}</p>
    <p>Total Records: {{ $total }}</p>
    <p>Available: {{ $available }} | Used: {{ $used }} | Expired: {{ $expired }}</p>
    <table border="1" width="100%">
        <tr><th>Blood Type</th><th>Total</th><th>Available</th><th>Used</th><th>Expired</th></tr>
        @foreach($byType as $r)
        <tr>
            <td>{{ $r->blood_type }}</td>
            <td>{{ $r->total_bags }}</td>
            <td>{{ $r->available }}</td>
            <td>{{ $r->used }}</td>
            <td>{{ $r->expired }}</td>
        </tr>
        @endforeach
    </table>
</body>
</html>