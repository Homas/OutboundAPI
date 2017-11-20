<?php
  $NIOS_baseURL="https://192.168.1.1/wapi/v2.5/";
  $NIOS_User="admin";
  $NIOS_PWD="infoblox";


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
         data=>[name=>"Qualys_Asset_VM", comment=>"Qualys OutboundAPI integration", type=>"ENUM", flags=>"I", default_value=>"true", list_values=>[[value=>"true"],[value=>"false"]]]],
         [call=>"extensibleattributedef",
         data=>[name=>"Qualys_Asset_PC", comment=>"Qualys OutboundAPI integration", type=>"ENUM", flags=>"I", default_value=>"true", list_values=>[[value=>"true"],[value=>"false"]]]],

         [call=>"extensibleattributedef",
         data=>[name=>"Qualys_Scan", comment=>"Qualys OutboundAPI integration", type=>"ENUM", flags=>"I", default_value=>"true", list_values=>[[value=>"true"],[value=>"false"]]]],
         [call=>"extensibleattributedef",
         data=>[name=>"Qualys_Scan_On_Add", comment=>"Qualys OutboundAPI integration", type=>"ENUM", flags=>"I", default_value=>"true", list_values=>[[value=>"true"],[value=>"false"]]]],

         [call=>"extensibleattributedef",
         data=>[name=>"Qualys_Assets_Group", comment=>"Qualys OutboundAPI integration", type=>"ENUM", flags=>"I", default_value=>"QLab", list_values=>[[value=>"Lab"],[value=>"QLab"]]]],

         [call=>"extensibleattributedef",
         data=>[name=>"Qualys_Scan_Option", comment=>"Qualys OutboundAPI integration", type=>"ENUM", flags=>"I", default_value=>"Authenticated Scan v.1", list_values=>[[value=>"Authenticated Scan v.1"],[value=>"Initial Options (default)"],[value=>"Qualys Top 20 Options"],[value=>"Payment Card Industry (PCI) Options"],[value=>"2008 SANS20 Options"]]]],
         [call=>"extensibleattributedef",
         data=>[name=>"Qualys_Scanner", comment=>"Qualys OutboundAPI integration", type=>"ENUM", flags=>"I", default_value=>"TMELab", list_values=>[[value=>"TMELab"]]]],
         [call=>"extensibleattributedef",
         data=>[name=>"Qualys_User_SNMP", comment=>"Qualys OutboundAPI integration", type=>"ENUM", flags=>"I", default_value=>"public", list_values=>[[value=>"public"]]]],
         [call=>"extensibleattributedef",
         data=>[name=>"Qualys_User_Unix", comment=>"Qualys OutboundAPI integration", type=>"ENUM", flags=>"I", default_value=>"infoblox", list_values=>[[value=>"infoblox"]]]],

  ];

  foreach ($data as $api_call){
    $data_string = json_encode($api_call{data});
    curl_setopt($ch, CURLOPT_URL, $NIOS_baseURL.$api_call{call});
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);

    $result = curl_exec($ch);
  #  print_r($result);
    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
  #  $res=json_decode($result);
  #  print_r($res);
  };

  curl_close($ch);

?>
