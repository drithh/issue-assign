<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Reminder: Issue Resolution Required</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      color: #333;
      line-height: 1.6;
      margin: 0;
      padding: 0;
      background-color: #f4f4f4;
    }

    .container {
      width: 80%;
      margin: auto;
      overflow: hidden;
      background: #fff;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h1 {
      color: #333;
    }

    p {
      margin: 10px 0;
    }

    .footer {
      margin-top: 20px;
      padding-top: 10px;
      border-top: 1px solid #ddd;
      text-align: center;
      font-size: 0.9em;
      color: #666;
    }
  </style>
</head>

<body>
  <div class="container">
      <h1>Reminder: Issue Resolution Required</h1>
      <p>Dear {{ $resolver_name }},</p>
      <p>This is a reminder regarding the issue <strong>{{ $issue_finding }}</strong> assigned to you. The issue was reported on <strong>{{ $issue_date }}</strong> and is currently in the following status:</p>

      <p><strong>Status:</strong> {{ $issue_status }}</p>
      <p><strong>Target Resolution Time:</strong> {{ $target_time }}</p>
      @if (isset($issue_comment))
          <p><strong>Comment:</strong> {{ $issue_comment }}</p>
      @endif
      <p>Please take the necessary actions to resolve this issue by the target time provided. Your timely resolution is crucial to maintaining our service standards.</p>

      <p>If you have any questions or require additional information, please do not hesitate to contact us.</p>

      <p>Thank you for your prompt attention to this matter.</p>
  </div>
</body>

</html>