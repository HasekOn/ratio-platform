Pozvánka do projektu {{ $project->name }}
<br>
Byli jste pozváni k účasti na projektu {{ $project->name }}.
<br>
<a href="{{ route('attachMemberToProject', [$remember_token, $invitation, $project]) }}">Accept invitation</a>
<br>
Thanks,<br>
{{ config('app.name') }}
