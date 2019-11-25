<?php

include_once('functions.php');


$pdo = dbConnect();

$results = $pdo->query("SELECT id from Buildings ORDER BY id");

while ($bld = $results->fetch(PDO::FETCH_ASSOC)) {

   $bldName = $bld['id'];

   echo "<option value=\"$bldName\"";

   if (isset($building)) {
      if ($building == $bldName) {
         echo " selected";
      }
   }
   
   echo ">$bldName</option>";




}






?>

<option value="AB Visual Arts Building">AB Visual Arts Building</option>



































<!-- <option value="AA Art Annex, 2211 Sycamore Rd">AA Art Annex, 2211 Sycamore Rd</option>
<option value="AB Visual Arts Building">AB Visual Arts Building</option>
<option value="AC Faculty Development and Instructional Design Center">AC Faculty Development and Instructional Design Center</option>
<option value="AD Adams Hall">AD Adams Hall</option>
<option value="AH Arndt House ">AH Arndt House </option>
<option value="AL Altgeld Hall">AL Altgeld Hall</option>
<option value="AN Anderson Hall">AN Anderson Hall</option>
<option value="AS Art Studios, 1650 Pleasant St">AS Art Studios, 1650 Pleasant St</option>
<option value="AV Barsema Alumni & Visitors Center">AV Barsema Alumni & Visitors Center</option>
<option value="BC Broadcast Center, 801 N First St">BC Broadcast Center, 801 N First St</option>
<option value="BH Barsema Hall">BH Barsema Hall</option>
<option value="CB Center for Black Studies">CB Center for Black Studies</option>
<option value="CC Child Care Center">CC Child Care Center</option>
<option value="CD Center for Diversity Resources">CD Center for Diversity Resources</option>
<option value="CF Center for the Study of Family Violence and Sexual Assault">CF Center for the Study of Family Violence and Sexual Assault</option>
<option value="CH Chessick Practice Center">CH Chessick Practice Center</option>
<option value="CL Campus Life">CL Campus Life</option>
<option value="CO Cole Hall">CO Cole Hall</option>
<option value="CP Chilled Water Plant">CP Chilled Water Plant</option>
<option value="CV Convocation Center">CV Convocation Center</option>
<option value="DB Dorland Building">DB Dorland Building</option>
<option value="DC New Residence Hall Community Center">DC New Residence Hall Community Center</option>
<option value="DD Douglas Hall">DD Douglas Hall</option>
<option value="DH Davis Hall">DH Davis Hall</option>
<option value="DU DuSable Hall">DU DuSable Hall</option>
<option value="EB Engineering Bldg">EB Engineering Bldg</option>
<option value="EF Evans Field House">EF Evans Field House</option>
<option value="EP East Heating Plant">EP East Heating Plant</option>
<option value="FO Founders Memorial Library">FO Founders Memorial Library</option>
<option value="FR Faraday Hall">FR Faraday Hall</option>
<option value="FW LaTourette Hall (formerly Faraday West)">FW LaTourette Hall (formerly Faraday West)</option>
<option value="GA Gabel Hall">GA Gabel Hall</option>
<option value="GC Zeke Giorgi Law Clinic">GC Zeke Giorgi Law Clinic</option>
<option value="GD Gilbert Hall">GD Gilbert Hall</option>
<option value="GH Graham Hall">GH Graham Hall</option>
<option value="GN Grant Towers North">GN Grant Towers North</option>
<option value="GO Grounds">GO Grounds</option>
<option value="GR Greenhouse">GR Greenhouse</option>
<option value="GS Grant Towers South">GS Grant Towers South</option>
<option value="HC Holmes Student Center">HC Holmes Student Center</option>
<option value="HE Hoffman Estates Education Center, 5555 Trillium Blvd, Hoffman Estates">HE Hoffman Estates Education Center, 5555 Trillium Blvd, Hoffman Estates</option>
<option value="HR Human Resources/Document Services, 1515 W. Lincoln Hwy">HR Human Resources/Document Services, 1515 W. Lincoln Hwy</option>
<option value="HS Health Service Center">HS Health Service Center</option>
<option value="IA Illinois ASBO/Public Administration, Lincoln & Carroll Av">IA Illinois ASBO/Public Administration, Lincoln & Carroll Av</option>
<option value="JH Jacobs House, 429 Garden Rd">JH Jacobs House, 429 Garden Rd</option>
<option value="LB National Bank & Trust, 155 N. Third St">LB National Bank & Trust, 155 N. Third St</option>
<option value="LC Latino Center, 515 Garden Rd">LC Latino Center, 515 Garden Rd</option>
<option value="LD Lincoln Hall">LD Lincoln Hall</option>
<option value="LH Lowden Hall">LH Lowden Hall</option>
<option value="LT Lorado Taft, Oregon">LT Lorado Taft, Oregon</option>
<option value="LW Labs for Wellness, 2280 Bethany Rd">LW Labs for Wellness, 2280 Bethany Rd</option>
<option value="MB Music Building">MB Music Building</option>
<option value="MC McMurry Hall">MC McMurry Hall</option>
<option value="MO Montgomery Hall">MO Montgomery Hall</option>
<option value="NC Neptune Central">NC Neptune Central</option>
<option value="NE Neptune East">NE Neptune East</option>
<option value="NN Neptune North">NN Neptune North</option>
<option value="NP Naperville Center, 1120 E. Diehl Rd, Naperville">NP Naperville Center, 1120 E. Diehl Rd, Naperville</option>
<option value="NS Nursing School, 1240 Normal Rd">NS Nursing School, 1240 Normal Rd</option>
<option value="NV Northern View Community">NV Northern View Community</option>
<option value="NW Neptune West">NW Neptune West</option>
<option value="OH Oderkirk House, 253 Annie Glidden Rd">OH Oderkirk House, 253 Annie Glidden Rd</option>
<option value="OS Outdoor Recreation Sports Complex">OS Outdoor Recreation Sports Complex</option>
<option value="PD Parking Deck">PD Parking Deck</option>
<option value="PK Parking, 121 Normal Rd">PK Parking, 121 Normal Rd</option>
<option value="PM Psychology/Computer Science">PM Psychology/Computer Science</option>
<option value="PP Physical Plant">PP Physical Plant</option>
<option value="PS Public Safety">PS Public Safety</option>
<option value="PT Pottenger House, 520 College View Ct">PT Pottenger House, 520 College View Ct</option>
<option value="RC Recreation Center">RC Recreation Center</option>
<option value="RE New Residence Hall East">RE New Residence Hall East</option>
<option value="RF Rockford Education Center, 8500 E State, Rockford">RF Rockford Education Center, 8500 E State, Rockford</option>
<option value="RH Reavis Hall">RH Reavis Hall</option>
<option value="RW New Residence Hall West">RW New Residence Hall West</option>
<option value="SA Stevens Annex">SA Stevens Annex</option>
<option value="SB Stevens Building">SB Stevens Building</option>
<option value="SC Speech & Hearing Clinic">SC Speech & Hearing Clinic</option>
<option value="SG Still Gym">SG Still Gym</option>
<option value="SH Still Hall">SH Still Hall</option>
<option value="SI Building Services">SI Building Services</option>
<option value="SN Stevenson Towers North">SN Stevenson Towers North</option>
<option value="SP Swen Parson">SP Swen Parson</option>
<option value="SR Social Science Research Institute (Monat Building), 3rd St & Locust St">SR Social Science Research Institute (Monat Building), 3rd St & Locust St</option>
<option value="SS Stevenson Towers South">SS Stevenson Towers South</option>
<option value="ST Huskie Stadium">ST Huskie Stadium</option>
<option value="TS Telephone & Security Building">TS Telephone & Security Building</option>
<option value="TV Television Center">TV Television Center</option>
<option value="UA University Apartments">UA University Apartments</option>
<option value="UC University City, 817 W Lincoln Hwy">UC University City, 817 W Lincoln Hwy</option>
<option value="WH Watson Hall">WH Watson Hall</option>
<option value="WI Williston Hall">WI Williston Hall</option>
<option value="WL Wellness/Literacy, 3100 Sycamore Rd">WL Wellness/Literacy, 3100 Sycamore Rd</option>
<option value="WP West Heating Plant">WP West Heating Plant</option>
<option value="WZ Wirtz Hall">WZ Wirtz Hall</option>
<option value="YC Yordon Academic and Athletic Performance Center">YC Yordon Academic and Athletic Performance Center</option>
<option value="ZH Zulauf Hall">ZH Zulauf Hall</option> -->
