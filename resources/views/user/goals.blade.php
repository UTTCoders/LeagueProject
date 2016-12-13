<table style="display:block;">
  <tr align="center">
    <td style="vertical-align: middle;"><img style="width: 60%" src="/storage/{{$teams['local']->logo}}"></td>
    <td style="vertical-align: middle;"></td>
    <td style="vertical-align: middle;"><img style="width: 60%" src="/storage/{{$teams['visitor']->logo}}"></td>
  </tr>
  <tr align="center">
    <td style="vertical-align: middle;"><b style="font-size:35px; color: #B71C1C;">{{$teams["local"]["goals"]}}</b></td>
    <td style="vertical-align: middle;"><span style="font-weight:bold; font-size:20px;">VS</span></td>
    <td style="vertical-align: middle;"><b style="font-size:35px; color: #B71C1C;">{{$teams["visitor"]["goals"]}}</b></td>
  </tr>
</table>
<input type="hidden" name="goalsCount" value="{{$match->goals()->count()}}">
