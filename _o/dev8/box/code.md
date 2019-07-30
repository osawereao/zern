INSERT RECORD
========================================
	$username = 'dev8';
	$input['Username'] = oAuth::ocrypt($username, 'oEN64');
	$input['Email'] = oAuth::ocrypt($username.'@zenq.ca', 'oEN64');
	$input['Phone'] = '09026636728';
	$input['Password'] = oAuth::password('oDev8#');
	$input['PIN'] = 1314;
	$input['Type'] = oAuth::ocrypt('software', 'oENCODE');
	$input['Privilege'] = 20;

	$input['LastName'] = oAuth::ocrypt('Osawere', 'oENCODE');
	$input['FirstName'] = oAuth::ocrypt('Anthony', 'oENCODE');
	$input['OtherName'] = oAuth::ocrypt('ODAO', 'oENCODE');

	$input['DOB'] = oPeriod::create('October 31, 1987','oMYSQLDATE');
	$input['Sex'] = 'M';
	$input['LGA'] = 'Oredo';
	$input['State'] = 'Edo';
	$input['Country'] = 'NG';

	$input['ReferralID'] = 'Dev8';
	$input['ReferrerID'] = 'SELF';

	$Insert = $zern->DB->createSQL('oUSER_TABLE', $input);







	function htmlNoRecord($title='', $msg=''){
	if(empty($msg)){
		$msg = 'SORRY, NO RECORDS FOUND!';
		// $msg = 'Sorry, <br> There are no records found!';
	}
	$html = '
					<div class="row">
					<div class="col-sm-12">
						<div class="card-box">
							<div class="card-block">';
	if(!empty($title)){
		$html .= '<h4 class="card-title zern-danger-border">'.ucwords($title).'</h4>';
	}

	$html .= '

								<div class="table-responsive">
									<p class="text-danger">'.$msg.'</p>
								</div>
							</div>
						</div>
					</div>
					</div>';
return $html;
}