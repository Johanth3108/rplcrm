@extends('layouts.salesmanager')


@section('content')
@if ($message = Session::get('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
	<strong>{{$message}}</strong>
	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		<span aria-hidden="true">&times;</span>
	</button>
</div>
@endif

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{route('salesmanager.home')}}">SAGI CRM</a></li>
      <li class="breadcrumb-item"><a href="#">Generated leads</a></li>
      <li class="breadcrumb-item active" aria-current="page">lead</li>
    </ol>
</nav>
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">{{$lead->property_name}}</h6>
                <form class="forms-sample" action="{{ route('salesmanager.leads.save', $lead->id) }}" method="POST" >
                    @csrf
                    <div class="form-group">
                        <label for="exampleFormControlSelect1"> Property name</label>
                        <select name="property_id" class="form-control" id="exampleFormControlSelect1" required>
                            <option value="" disabled>Select a property</option>
                            @foreach ($props as $prop)
                            <option value="{{$prop->id}}" @if ($prop->propname==$property->propname)
                                selected
                            @endif>{{$prop->propname}}</option>
                            @endforeach
                            
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="exampleInputUsername1">Address</label>
                        <input type="text" class="form-control" name="address" value="{{$lead->address}}" id="exampleInputUsername1" autocomplete="off" placeholder="Property Location" required>
                    </div>

                    <div class="form-group">
                        <label for="inputState">State</label>
                        <select name="state" class="form-control" id="inputState" required>
                          <option value="">Select State</option>
                          <option value="Andra Pradesh" id="Andra Pradesh">Andra Pradesh</option>
                          <option value="Arunachal Pradesh" id="Arunachal Pradesh">Arunachal Pradesh</option>
                          <option value="Assam" id="Assam">Assam</option>
                          <option value="Bihar" id="Bihar">Bihar</option>
                          <option value="Chhattisgarh" id="Chhattisgarh">Chhattisgarh</option>
                          <option value="Goa" id="Goa">Goa</option>
                          <option value="Gujarat" id="Gujarat">Gujarat</option>
                          <option value="Haryana" id="Haryana">Haryana</option>
                          <option value="Himachal Pradesh" id="Himachal Pradesh">Himachal Pradesh</option>
                          <option value="Jammu and Kashmir" id="Jammu and Kashmir">Jammu and Kashmir</option>
                          <option value="Jharkhand" id="Jharkhand">Jharkhand</option>
                          <option value="Karnataka" id="Karnataka">Karnataka</option>
                          <option value="Kerala" id="Kerala">Kerala</option>
                          <option value="Madya Pradesh" id="Madya Pradesh">Madya Pradesh</option>
                          <option value="Maharashtra" id="Maharashtra">Maharashtra</option>
                          <option value="Manipur" id="Manipur">Manipur</option>
                          <option value="Meghalaya" id="Meghalaya">Meghalaya</option>
                          <option value="Mizoram" id="Mizoram">Mizoram</option>
                          <option value="Nagaland" id="Nagaland">Nagaland</option>
                          <option value="Orissa" id="Orissa">Orissa</option>
                          <option value="Punjab" id="Punjab">Punjab</option>
                          <option value="Rajasthan" id="Rajasthan">Rajasthan</option>
                          <option value="Sikkim" id="Sikkim">Sikkim</option>
                          <option value="Tamil Nadu" id="Tamil Nadu">Tamil Nadu</option>
                          <option value="Telangana" id="Telangana">Telangana</option>
                          <option value="Tripura" id="Tripura">Tripura</option>
                          <option value="Uttarakhand" id="Uttarakhand">Uttarakhand</option>
                          <option value="Uttar Pradesh" id="Uttar Pradesh">Uttar Pradesh</option>
                          <option value="West Bengal" id="West Bengal">West Bengal</option>
                          <option disabled style="background-color:#aaa; color:#fff">UNION Territories</option>
                          <option value="Andaman and Nicobar Islands" id="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
                          <option value="Chandigarh" id="Chandigarh">Chandigarh</option>
                          <option value="Dadar and Nagar Haveli" id="Dadar and Nagar Haveli">Dadar and Nagar Haveli</option>
                          <option value="Daman and Diu" id="Daman and Diu">Daman and Diu</option>
                          <option value="Delhi" id="Delhi">Delhi</option>
                          <option value="Lakshadeep" id="Lakshadeep">Lakshadeep</option>
                          <option value="Pondicherry" id="Pondicherry">Pondicherry</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="inputDistrict">District</label>
                        <select name="district" class="form-control" id="inputDistrict" required>
                            <option value="{{$lead->district}}" selected>{{$lead->district}} </option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlSelect1"> Property Type</label>
                        <select name="prop_type" class="form-control" id="exampleFormControlSelect1" required>
                            <option value="">Select a property type</option>
                            @foreach ($prop_types as $prop_type)
                            <option value="{{$prop_type->prop_type}}" @if ($prop_type->prop_type==$lead->prop_type)
                                selected
                            @endif>{{$prop_type->prop_type}}</option>
                            @endforeach
                            
                        </select>
                    </div>

                    

                    {{-- <div class="form-group">
                        <label for="exampleFormControlSelect1">From</label>
                        <select required name="lead_from" class="form-control" id="exampleFormControlSelect1">
                            <option selected disabled>Select user type</option>
                            <option>99 acer </option>
                            <option>Magic Brick </option>
                            <option>Manual </option>
                            <option>Housing.com</option>
                            
                        </select>
                    </div> --}}
                    <div class="form-group">
                        <label for="salesman">Assigned salesmanager</label>
                        <select name="salesman" class="form-control" id="salesman" required>
                            <option value="" selected disabled>Assigning salesmanager</option>
                            @foreach ($users as $user)
                            @if ($user->salesmanager==true)
                            <option value="{{$user->id}}"@if ($user->id==$lead->assigned_man) selected @endif>
                                {{$user->name}}</option>
                            @endif
                            @endforeach
                            
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="salesexe">Assigning salesexecutive</label>
                        <select name="salesexe" class="form-control" id="salesexe" required>
                            <option value="" selected disabled>Assigning salesexecutive</option>
                            @foreach ($users as $user)
                            @if ($user->salesexecutive==true)
                            <option value="{{$user->id}}"@if ($user->id==$lead->assigned_exe) selected @endif>
                                {{$user->name}}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="status">Status</label>
                        <select name="status" id="status" class="form-control" id="status" required>
                            <option value="" selected disabled>Select a status</option>
                            @foreach ($status as $stat)
                            <option value="{{$stat->id}}" @if ($stat->id==$lead->status) selected @endif>{{$stat->status}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputUsername1">Lead from</label>
                        <input type="text" class="form-control" value="{{$lead->lead_from}}" name="lead_from" id="exampleInputUsername1" autocomplete="off" placeholder="Property Location" required disabled>
                    </div>
                    <div class="form-group">
                        <label for="feedback">Feedback</label>
                        <textarea name="feedback" id="feedback" class="form-control" cols="30" rows="10" placeholder="Leave your comments for this lead here...">{{$lead->feedback}}</textarea>
                    </div>
                
                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    <a href="{{URL::previous()}}" class="btn btn-light">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

<script>
var AndraPradesh = ["Anantapur","Chittoor","East Godavari","Guntur","Kadapa","Krishna","Kurnool","Prakasam","Nellore","Srikakulam","Visakhapatnam","Vizianagaram","West Godavari"];
var ArunachalPradesh = ["Anjaw","Changlang","Dibang Valley","East Kameng","East Siang","Kra Daadi","Kurung Kumey","Lohit","Longding","Lower Dibang Valley","Lower Subansiri","Namsai","Papum Pare","Siang","Tawang","Tirap","Upper Siang","Upper Subansiri","West Kameng","West Siang","Itanagar"];
var Assam = ["Baksa","Barpeta","Biswanath","Bongaigaon","Cachar","Charaideo","Chirang","Darrang","Dhemaji","Dhubri","Dibrugarh","Goalpara","Golaghat","Hailakandi","Hojai","Jorhat","Kamrup Metropolitan","Kamrup (Rural)","Karbi Anglong","Karimganj","Kokrajhar","Lakhimpur","Majuli","Morigaon","Nagaon","Nalbari","Dima Hasao","Sivasagar","Sonitpur","South Salmara Mankachar","Tinsukia","Udalguri","West Karbi Anglong"];
var Bihar = ["Araria","Arwal","Aurangabad","Banka","Begusarai","Bhagalpur","Bhojpur","Buxar","Darbhanga","East Champaran","Gaya","Gopalganj","Jamui","Jehanabad","Kaimur","Katihar","Khagaria","Kishanganj","Lakhisarai","Madhepura","Madhubani","Munger","Muzaffarpur","Nalanda","Nawada","Patna","Purnia","Rohtas","Saharsa","Samastipur","Saran","Sheikhpura","Sheohar","Sitamarhi","Siwan","Supaul","Vaishali","West Champaran"];
var Chhattisgarh = ["Balod","Baloda Bazar","Balrampur","Bastar","Bemetara","Bijapur","Bilaspur","Dantewada","Dhamtari","Durg","Gariaband","Janjgir Champa","Jashpur","Kabirdham","Kanker","Kondagaon","Korba","Koriya","Mahasamund","Mungeli","Narayanpur","Raigarh","Raipur","Rajnandgaon","Sukma","Surajpur","Surguja"];
var Goa = ["North Goa","South Goa"];
var Gujarat = ["Ahmedabad","Amreli","Anand","Aravalli","Banaskantha","Bharuch","Bhavnagar","Botad","Chhota Udaipur","Dahod","Dang","Devbhoomi Dwarka","Gandhinagar","Gir Somnath","Jamnagar","Junagadh","Kheda","Kutch","Mahisagar","Mehsana","Morbi","Narmada","Navsari","Panchmahal","Patan","Porbandar","Rajkot","Sabarkantha","Surat","Surendranagar","Tapi","Vadodara","Valsad"];
var Haryana = ["Ambala","Bhiwani","Charkhi Dadri","Faridabad","Fatehabad","Gurugram","Hisar","Jhajjar","Jind","Kaithal","Karnal","Kurukshetra","Mahendragarh","Mewat","Palwal","Panchkula","Panipat","Rewari","Rohtak","Sirsa","Sonipat","Yamunanagar"];
var HimachalPradesh = ["Bilaspur","Chamba","Hamirpur","Kangra","Kinnaur","Kullu","Lahaul Spiti","Mandi","Shimla","Sirmaur","Solan","Una"];
var JammuKashmir = ["Anantnag","Bandipora","Baramulla","Budgam","Doda","Ganderbal","Jammu","Kargil","Kathua","Kishtwar","Kulgam","Kupwara","Leh","Poonch","Pulwama","Rajouri","Ramban","Reasi","Samba","Shopian","Srinagar","Udhampur"];
var Jharkhand = ["Bokaro","Chatra","Deoghar","Dhanbad","Dumka","East Singhbhum","Garhwa","Giridih","Godda","Gumla","Hazaribagh","Jamtara","Khunti","Koderma","Latehar","Lohardaga","Pakur","Palamu","Ramgarh","Ranchi","Sahebganj","Seraikela Kharsawan","Simdega","West Singhbhum"];
var Karnataka = ["Bagalkot","Bangalore Rural","Bangalore Urban","Belgaum","Bellary","Bidar","Vijayapura","Chamarajanagar","Chikkaballapur","Chikkamagaluru","Chitradurga","Dakshina Kannada","Davanagere","Dharwad","Gadag","Gulbarga","Hassan","Haveri","Kodagu","Kolar","Koppal","Mandya","Mysore","Raichur","Ramanagara","Shimoga","Tumkur","Udupi","Uttara Kannada","Yadgir"];
var Kerala = ["Alappuzha","Ernakulam","Idukki","Kannur","Kasaragod","Kollam","Kottayam","Kozhikode","Malappuram","Palakkad","Pathanamthitta","Thiruvananthapuram","Thrissur","Wayanad"];
var MadhyaPradesh = ["Agar Malwa","Alirajpur","Anuppur","Ashoknagar","Balaghat","Barwani","Betul","Bhind","Bhopal","Burhanpur","Chhatarpur","Chhindwara","Damoh","Datia","Dewas","Dhar","Dindori","Guna","Gwalior","Harda","Hoshangabad","Indore","Jabalpur","Jhabua","Katni","Khandwa","Khargone","Mandla","Mandsaur","Morena","Narsinghpur","Neemuch","Panna","Raisen","Rajgarh","Ratlam","Rewa","Sagar","Satna",
"Sehore","Seoni","Shahdol","Shajapur","Sheopur","Shivpuri","Sidhi","Singrauli","Tikamgarh","Ujjain","Umaria","Vidisha"];
var Maharashtra = ["Ahmednagar","Akola","Amravati","Aurangabad","Beed","Bhandara","Buldhana","Chandrapur","Dhule","Gadchiroli","Gondia","Hingoli","Jalgaon","Jalna","Kolhapur","Latur","Mumbai City","Mumbai Suburban","Nagpur","Nanded","Nandurbar","Nashik","Osmanabad","Palghar","Parbhani","Pune","Raigad","Ratnagiri","Sangli","Satara","Sindhudurg","Solapur","Thane","Wardha","Washim","Yavatmal"];
var Manipur = ["Bishnupur","Chandel","Churachandpur","Imphal East","Imphal West","Jiribam","Kakching","Kamjong","Kangpokpi","Noney","Pherzawl","Senapati","Tamenglong","Tengnoupal","Thoubal","Ukhrul"];
var Meghalaya = ["East Garo Hills","East Jaintia Hills","East Khasi Hills","North Garo Hills","Ri Bhoi","South Garo Hills","South West Garo Hills","South West Khasi Hills","West Garo Hills","West Jaintia Hills","West Khasi Hills"];
var Mizoram = ["Aizawl","Champhai","Kolasib","Lawngtlai","Lunglei","Mamit","Saiha","Serchhip","Aizawl","Champhai","Kolasib","Lawngtlai","Lunglei","Mamit","Saiha","Serchhip"];
var Nagaland = ["Dimapur","Kiphire","Kohima","Longleng","Mokokchung","Mon","Peren","Phek","Tuensang","Wokha","Zunheboto"];
var Odisha = ["Angul","Balangir","Balasore","Bargarh","Bhadrak","Boudh","Cuttack","Debagarh","Dhenkanal","Gajapati","Ganjam","Jagatsinghpur","Jajpur","Jharsuguda","Kalahandi","Kandhamal","Kendrapara","Kendujhar","Khordha","Koraput","Malkangiri","Mayurbhanj","Nabarangpur","Nayagarh","Nuapada","Puri","Rayagada","Sambalpur","Subarnapur","Sundergarh"];
var Punjab = ["Amritsar","Barnala","Bathinda","Faridkot","Fatehgarh Sahib","Fazilka","Firozpur","Gurdaspur","Hoshiarpur","Jalandhar","Kapurthala","Ludhiana","Mansa","Moga","Mohali","Muktsar","Pathankot","Patiala","Rupnagar","Sangrur","Shaheed Bhagat Singh Nagar","Tarn Taran"];
var Rajasthan = ["Ajmer","Alwar","Banswara","Baran","Barmer","Bharatpur","Bhilwara","Bikaner","Bundi","Chittorgarh","Churu","Dausa","Dholpur","Dungarpur","Ganganagar","Hanumangarh","Jaipur","Jaisalmer","Jalore","Jhalawar","Jhunjhunu","Jodhpur","Karauli","Kota","Nagaur","Pali","Pratapgarh","Rajsamand","Sawai Madhopur","Sikar","Sirohi","Tonk","Udaipur"];
var Sikkim = ["East Sikkim","North Sikkim","South Sikkim","West Sikkim"];
var TamilNadu = ["Ariyalur","Chennai","Coimbatore","Cuddalore","Dharmapuri","Dindigul","Erode","Kanchipuram","Kanyakumari","Karur","Krishnagiri","Madurai","Nagapattinam","Namakkal","Nilgiris","Perambalur","Pudukkottai","Ramanathapuram","Salem","Sivaganga","Thanjavur","Theni","Thoothukudi","Tiruchirappalli","Tirunelveli","Tiruppur","Tiruvallur","Tiruvannamalai","Tiruvarur","Vellore","Viluppuram","Virudhunagar"];
var Telangana = ["Adilabad","Bhadradri Kothagudem","Hyderabad","Jagtial","Jangaon","Jayashankar","Jogulamba","Kamareddy","Karimnagar","Khammam","Komaram Bheem","Mahabubabad","Mahbubnagar","Mancherial","Medak","Medchal","Nagarkurnool","Nalgonda","Nirmal","Nizamabad","Peddapalli","Rajanna Sircilla","Ranga Reddy","Sangareddy","Siddipet","Suryapet","Vikarabad","Wanaparthy","Warangal Rural","Warangal Urban","Yadadri Bhuvanagiri"];
var Tripura = ["Dhalai","Gomati","Khowai","North Tripura","Sepahijala","South Tripura","Unakoti","West Tripura"];
var UttarPradesh = ["Agra","Aligarh","Allahabad","Ambedkar Nagar","Amethi","Amroha","Auraiya","Azamgarh","Baghpat","Bahraich","Ballia","Balrampur","Banda","Barabanki","Bareilly","Basti","Bhadohi","Bijnor","Budaun","Bulandshahr","Chandauli","Chitrakoot","Deoria","Etah","Etawah","Faizabad","Farrukhabad","Fatehpur","Firozabad","Gautam Buddha Nagar","Ghaziabad","Ghazipur","Gonda","Gorakhpur","Hamirpur","Hapur","Hardoi","Hathras","Jalaun","Jaunpur","Jhansi","Kannauj","Kanpur Dehat","Kanpur Nagar","Kasganj","Kaushambi","Kheri","Kushinagar","Lalitpur","Lucknow","Maharajganj","Mahoba","Mainpuri","Mathura","Mau","Meerut","Mirzapur","Moradabad","Muzaffarnagar","Pilibhit","Pratapgarh","Raebareli","Rampur","Saharanpur","Sambhal","Sant Kabir Nagar","Shahjahanpur","Shamli","Shravasti","Siddharthnagar","Sitapur","Sonbhadra","Sultanpur","Unnao","Varanasi"];
var Uttarakhand  = ["Almora","Bageshwar","Chamoli","Champawat","Dehradun","Haridwar","Nainital","Pauri","Pithoragarh","Rudraprayag","Tehri","Udham Singh Nagar","Uttarkashi"];
var WestBengal = ["Alipurduar","Bankura","Birbhum","Cooch Behar","Dakshin Dinajpur","Darjeeling","Hooghly","Howrah","Jalpaiguri","Jhargram","Kalimpong","Kolkata","Malda","Murshidabad","Nadia","North 24 Parganas","Paschim Bardhaman","Paschim Medinipur","Purba Bardhaman","Purba Medinipur","Purulia","South 24 Parganas","Uttar Dinajpur"];
var AndamanNicobar = ["Nicobar","North Middle Andaman","South Andaman"];
var Chandigarh = ["Chandigarh"];
var DadraHaveli = ["Dadra Nagar Haveli"];
var DamanDiu = ["Daman","Diu"];
var Delhi = ["Central Delhi","East Delhi","New Delhi","North Delhi","North East Delhi","North West Delhi","Shahdara","South Delhi","South East Delhi","South West Delhi","West Delhi"];
var Lakshadweep = ["Lakshadweep"];
var Puducherry = ["Karaikal","Mahe","Puducherry","Yanam"];


$("#inputState").change(function(){
  var StateSelected = $(this).val();
  var optionsList;
  var htmlString = "";

  switch (StateSelected) {
    case "Andra Pradesh":
        optionsList = AndraPradesh;
        break;
    case "Arunachal Pradesh":
        optionsList = ArunachalPradesh;
        break;
    case "Assam":
        optionsList = Assam;
        break;
    case "Bihar":
        optionsList = Bihar;
        break;
    case "Chhattisgarh":
        optionsList = Chhattisgarh;
        break;
    case "Goa":
        optionsList = Goa;
        break;
    case  "Gujarat":
        optionsList = Gujarat;
        break;
    case "Haryana":
        optionsList = Haryana;
        break;
    case "Himachal Pradesh":
        optionsList = HimachalPradesh;
        break;
    case "Jammu and Kashmir":
        optionsList = JammuKashmir;
        break;
    case "Jharkhand":
        optionsList = Jharkhand;
        break;
    case  "Karnataka":
        optionsList = Karnataka;
        break;
    case "Kerala":
        optionsList = Kerala;
        break;
    case  "Madya Pradesh":
        optionsList = MadhyaPradesh;
        break;
    case "Maharashtra":
        optionsList = Maharashtra;
        break;
    case  "Manipur":
        optionsList = Manipur;
        break;
    case "Meghalaya":
        optionsList = Meghalaya ;
        break;
    case  "Mizoram":
        optionsList = Mizoram;
        break;
    case "Nagaland":
        optionsList = Nagaland;
        break;
    case  "Orissa":
        optionsList = Orissa;
        break;
    case "Punjab":
        optionsList = Punjab;
        break;
    case  "Rajasthan":
        optionsList = Rajasthan;
        break;
    case "Sikkim":
        optionsList = Sikkim;
        break;
    case  "Tamil Nadu":
        optionsList = TamilNadu;
        break;
    case  "Telangana":
        optionsList = Telangana;
        break;
    case "Tripura":
        optionsList = Tripura ;
        break;
    case  "Uttarakhand":
        optionsList = Uttarakhand;
        break;
    case  "Uttar Pradesh":
        optionsList = UttarPradesh;
        break;
    case "West Bengal":
        optionsList = WestBengal;
        break;
    case  "Andaman and Nicobar Islands":
        optionsList = AndamanNicobar;
        break;
    case "Chandigarh":
        optionsList = Chandigarh;
        break;
    case  "Dadar and Nagar Haveli":
        optionsList = DadraHaveli;
        break;
    case "Daman and Diu":
        optionsList = DamanDiu;
        break;
    case  "Delhi":
        optionsList = Delhi;
        break;
    case "Lakshadeep":
        optionsList = Lakshadeep ;
        break;
    case  "Pondicherry":
        optionsList = Pondicherry;
        break;
}


  for(var i = 0; i < optionsList.length; i++){
    htmlString = htmlString+"<option value='"+ optionsList[i] +"'>"+ optionsList[i] +"</option>";
  }
  $("#inputDistrict").html(htmlString);

});
document.getElementById('{{$lead->state}}').selected = true;
// console.log(document.querySelectorAll("input[value={{$lead->district}}]"));
</script>
@endsection