<?php
  $NIOS_baseURL="https://10.60.32.70/wapi/v2.6/";
  $NIOS_User="admin";
  $NIOS_PWD="InfobloxFS";


  #extensibleattributedef

  $ch = curl_init();
  curl_setopt_array($ch,array(
    CURLOPT_USERPWD => $NIOS_User . ":" . $NIOS_PWD,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_SSL_VERIFYPEER => false,
#    CURLOPT_VERBOSE => true,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTPHEADER => array('Content-Type: application/json')
    )
  );

  $data=[
         [call=>"extensibleattributedef",
         data=>[name=>"FS_Sync", comment=>"ForeScout sync the object", type=>"ENUM", flags=>"I", default_value=>"true", list_values=>[[value=>"true"],[value=>"false"]]]],

         [call=>"extensibleattributedef",
         data=>[name=>"FS_SyncedAt", comment=>"ForeScout sync Date/Time", type=>"STRING"]],

         [call=>"extensibleattributedef",
         data=>[name=>"FS_RemediatedAt", comment=>"ForeScout sync Date/Time", type=>"STRING"]],

         [call=>"extensibleattributedef",
         data=>[name=>"FS_RemediateOnEvent", comment=>"ForeScout remediate by an event", type=>"ENUM", flags=>"I", default_value=>"true", list_values=>[[value=>"true"],[value=>"false"]]]],

         [call=>"extensibleattributedef",
         data=>[name=>"FS_Site", comment=>"ForeScout site name", type=>"ENUM", flags=>"I", default_value=>"Lab", list_values=>[[value=>"Lab"],[value=>"HQ"]]]],


  ];

  foreach ($data as $api_call){
    $data_string = json_encode($api_call{data});
    curl_setopt($ch, CURLOPT_URL, $NIOS_baseURL.$api_call{call});
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);

    $result = curl_exec($ch);
  #  print_r($result);
    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $res=json_decode($result);
    print_r($res);
  };

  curl_close($ch);

?>
