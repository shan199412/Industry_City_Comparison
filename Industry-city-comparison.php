<?php
if (!defined('ABSPATH')) {
	exit;
}
$username = "zxl101";
$password = "S079z079";
$host = "mytestdb.cjkcq2pcruvk.us-east-2.rds.amazonaws.com";
$database="iter2";

$connect = mysqli_connect( $host, $username, $password, $database );

$myquery = "select year(pop_year) as year, bus_no/sum(pop_no) *50000 as bus_no_per_pop, city_name, bus_type_des, c.city_id FROM population_no as pn join city as c 
            on pn.city_id = c.city_id join age_type as aget on pn.age_type_id = aget.age_type_id
            join  business_number as bn on bn.city_id = c.city_id join business_type as bt on bn.bus_type_id = bt.bus_type_id
             where aget.age_type_id in (4,5,6,7,8,9,10,11,12,13) and year(pop_year) = 2017 group by city_name, pop_year, bn.bus_type_id;";

$query = mysqli_query($connect, $myquery);

$bus_no    = array();
while ( $row = mysqli_fetch_assoc( $query ) ) {
	$element = array();
	$element['bus_type'] = $row['bus_type_des'];
	$element['bus_no'] = $row['bus_no_per_pop'];
	$element['city_id'] = $row['city_id'];
	$element['city_name'] = $row['city_name'];
	$element['year'] = $row["year"];
	$bus_no[] = $element;
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
	<head>
		<meta charset="utf-8">
		<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
		<link rel="stylesheet" href="css/indcity_style.css">
		<script type="text/javascript" src="js/indcity_script.js"></script>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">

		<link rel="stylesheet" href="css/inddia_style.css">
		<script src="http://d3js.org/d3.v3.min.js"></script>
		<script src="http://labratrevenge.com/d3-tip/javascripts/d3.tip.v0.6.3.js"></script>
		<script src="https://d3js.org/d3-axis.v1.min.js"></script>
	</head>

	<body>
<!--	<div class="section2" >-->
<!--		<div id="form1" style="text-align: center">-->
<!--			<p></p>-->
<!--			<label class="text_label_a">Select a city you would like to compare:</label>-->
<!--			<br>-->
<!--			<select id="city">-->
<!--				<option value="0">--select a city--</option>-->
<!--				<option value="1">Ballarat</option>-->
<!--				<option value="2">Greater Bendigo</option>-->
<!--				<option value="3">Greater Geelong</option>-->
<!--				<option value="4">Greater Shepparton</option>-->
<!--				<option value="5">Horsham</option>-->
<!--				<option value="6">Latrobe</option>-->
<!--				<option value="7">Mildura</option>-->
<!--				<option value="8">Wangaratta</option>-->
<!--				<option value="9">Warrnambool</option>-->
<!--				<option value="10">Wodonga</option>-->
<!--			</select>-->
<!--		</div>-->
<!--	</div>-->
	<br>
	<div class="section3" style="text-align: center">
		<p></p>
		<label class="text_label_a">Select up to four Regional Cities to compare:</label>
		<hr>
        <br>
		<div id="checkbox" style="text-align: center">

			<label class="city_c" id="1">
				<input class="checkcity" type="checkbox" id="1">
				Ballarat
				<span class="checkmark3"></span>
			</label>

			<label class="city_c" id="2">
				<input class="checkcity" type="checkbox" id="2">
				Greater Bendigo
				<span class="checkmark3"></span>
			</label>

			<label class="city_c" id="3">
				<input class="checkcity" type="checkbox" id="3">
				Greater Geelong
				<span class="checkmark3"></span>
			</label>

			<label class="city_c" id="4">
				<input class="checkcity" type="checkbox" id="4">
				Greater Shepparton
				<span class="checkmark3"></span>
			</label>

			<label class="city_c" id="5">
				<input class="checkcity" type="checkbox" id="5">
				Horsham
				<span class="checkmark3"></span>
			</label>
			<br>

			<label class="city_c" id="6">
				<input class="checkcity" type="checkbox" id="6">
				Latrobe
				<span class="checkmark3"></span>
			</label>

			<label class="city_c" id="7">
				<input class="checkcity" type="checkbox" id="7">
				Mildura
				<span class="checkmark3"></span>
			</label>

			<label class="city_c" id="8">
				<input class="checkcity" type="checkbox" id="8">
				Wangaratta
				<span class="checkmark3"></span>
			</label>

			<label class="city_c" id="9">
				<input class="checkcity" type="checkbox" id="9">
				Warrnambool
				<span class="checkmark3"></span>
			</label>

			<label class="city_c" id="10">
				<input class="checkcity" type="checkbox" id="10">
				Wodonga
				<span class="checkmark3"></span>
			</label>

		</div>
		<p></p>
		<div class="s_button">
			<button class="submit_button">Submit</button>
		</div>


<!--		<div class="city_summary" style="display: none">-->
<!--			<div class="citys1">-->
<!--				<span style="font-weight: bold; font-size: 22px; color: #3498db">Ballarat</span>-->
<!--				<br>-->
<!--                <span style="font-size: 16px; line-height: 0.7">-->
<!--					Most industries are booming. Construction has the largest number of companies,<br>-->
<!--					followed by <b>Financial & Insurances services</b> which is the largest <span style="font-size: 20px; color: red; font-weight: bold">increase</span> (up <span style="font-size: 20px; color: red; font-weight: bold">22%</span>).<br>-->
<!--					The third is <b>Rental & Hiring & Real Estate services</b>.<br>-->
<!--                </span>-->
<!--			</div>-->
<!--			<div class="citys2" style="display: none">-->
<!--				<span style="font-weight: bold; font-size: 22px; color: #3498db">Greater Bendigo</span>-->
<!--				<br>-->
<!--                <span style="font-size: 16px; line-height: 0.7">-->
<!--					This is a city with a large population, so the advantage is not obvious from the per capital business volume.<br>-->
<!--					<b>Construction</b> has the largest number of companies, followed by <b>Rental & Hiring & Real Estate services</b>, <b>third professional</b><br>-->
<!--                </span>-->
<!--			</div>-->
<!---->
<!--			<div class="citys3" style="display: none">-->
<!--				<span style="font-weight: bold; font-size: 22px; color: #3498db">Greater Geelong</span>-->
<!--				<br>-->
<!--                <span style="font-size: 16px; line-height: 0.7">-->
<!--					The top three industries per capital are <b>Construction</b>,<br> <b>Rental & hiring & real estate services</b>, <b>Professional</b><br>-->
<!--                </span>-->
<!--            </div>-->
<!--			<div class="citys4" style="display: none">-->
<!--				<span style="font-weight: bold; font-size: 22px; color: #3498db">Greater Shepparton</span>-->
<!--				<br>-->
<!--                <span style="font-size: 16px; line-height: 0.7">-->
<!--					The top three industries per capital are <b>Agriculture & forestry & fishing</b>,<br> <b>Construction</b>, <b>Rental & Hiring & Real estate services</b><br>-->
<!--                </span>-->
<!--            </div>-->
<!--			<div class="citys5" style="display: none">-->
<!--				<span style="font-weight: bold; font-size: 22px; color: #3498db">Horsham</span>-->
<!--				<br>-->
<!--                <span style="font-size: 16px; line-height: 0.7">-->
<!--					The top three industries per capital are <b>Agriculture & forestry & fishing</b>, <br><b>Construction</b>, <b>Rental & hiring & real estate services</b><br>-->
<!--                </span>-->
<!--            </div>-->
<!--			<div class="citys6" style="display: none">-->
<!--				<span style="font-weight: bold; font-size: 22px; color: #3498db">Latrobe</span>-->
<!--				<br>-->
<!--                <span style="font-size: 16px; line-height: 0.7">-->
<!--					The top three industries per capital are <b>Construction</b>,<br> <b>Rental & Hiring & Real estate services</b>, <b>Agriculture & Forestry & Fishing</b><br>-->
<!--                </span>-->
<!--            </div>-->
<!--			<div class="citys7" style="display: none">-->
<!--				<span style="font-weight: bold; font-size: 22px; color: #3498db">Mildura</span>-->
<!--				<br>-->
<!--                <span style="font-size: 16px; line-height: 0.7">-->
<!--					The top three industries per capital are <b>Agriculture & Forestry & Fishing</b>,<br> <b>Construction</b>, <b>Rental & Hiring & Real Estate services</b><br>-->
<!--                </span>-->
<!--            </div>-->
<!--			<div class="citys8" style="display: none">-->
<!--				<span style="font-weight: bold; font-size: 22px; color: #3498db">Wangaratta</span>-->
<!--				<br>-->
<!--                <span style="font-size: 16px; line-height: 0.7">-->
<!--					The top three industries per capital are <b>Agriculture & Forestry & Fishing</b>, <b>Construction</b>, <b>Rental & Hiring & Real Estate services</b><br>-->
<!--                </span>-->
<!--            </div>-->
<!--			<div class="citys9" style="display: none">-->
<!--				<span style="font-weight: bold; font-size: 22px; color: #3498db">Warrnambool</span>-->
<!--				<br>-->
<!--                <span style="font-size: 16px; line-height: 0.7">-->
<!--					The top three industries per capital are <b>Construction</b>, <b>Rental & Hiring & Real Estate services, Agriculture & Forestry & Fishing</b><br>-->
<!--                </span>-->
<!--            </div>-->
<!--			<div class="citys10" style="display: none">-->
<!--				<span style="font-weight: bold; font-size: 22px; color: #3498db">Wodonga</span>-->
<!--				<br>-->
<!--                <span style="font-size: 16px; line-height: 0.7">-->
<!--					The top three industries per capital are <b>Construction</b>, <b>Rental & Hiring & Real Estate services, Agriculture & Forestry & Fishing</b><br>-->
<!--                </span>-->
<!--            </div>-->
<!--		</div>-->

		<div class="alert1" style="display: none">
			<p style="text-align: center; color: red; font-size: 22px; font-weight: bold;">You can't only choose one city!</p>
		</div>

<!--		<br>-->
<!--		<div class="result" style="display: none"></div>-->
        <br>
        <div class="diagram_title" style="display: none">
            <span style="font-size: 20px; font-weight: bold">------ <i class="far fa-chart-bar"> Number of business per 10,000 people in each city in 2017</i> ------</span>
        </div>

		<div class="svg1" style="display: none">
		</div>

	</body>

	<script>
        var bus_no_data = <?php echo json_encode($bus_no); ?>;

	</script>
</html>