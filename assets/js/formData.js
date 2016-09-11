var app = angular.module('incidentsApp', []);
app.controller('incidentsCtrl', function($scope, $compile){
   // array data here
   $scope.formFields = [
      {
         header: "Description",
         desc: "Please provide a 1-2 sentence description of the privacy incident",
         type: "text"
      },
      {
         header: "Public Link",
         desc: "Please provide a link to a publicly accessible page (e.g. a news article) that describes the incident.",
         type: "text"
      },
      {
         header: "Your email address",
         desc: "Please enter your email address so that we can contact you if we have questions about the incident. We will *not* publish your email address on the site.",
         type: "email"
      },
      {
         header: "Date",
         desc: "Please enter the mm/dd/yy on which the incident was first publicly known (as far as you know). We don't need the precise day.",
         type: "text"
      }
   ];
   
   $scope.entities = ["#Alibaba", "#Amazon", "#Asos", "#Baidu", "#Ebay", "#Expedia",
      "#Facebook", "#Google", "#GooglePlay", "#Government", "#Groupon", "#Healthcare",
      "#InternetCompany", "#Jd.com", "#Linkedin", "#Netease", "#Netflix", "#PhoneCompany",
      "#Pricline", "#Rakuten", "#Salesforce", "#Tandex", "#Tripadvisor", "#Twitter",
      "#Yahoo"
   ];
   
   $scope.types = ["#Ads", "#ContactAccess", "#Cookies", "#CyberBullying", "#CyberStalking",
      "#DataAggregation", "#DataCollection", "#DataSharing", "#DataUsage", "#Defamation",
      "#DocumentAccess", "#Drone", "#EmailAccess", "#Hipaa", "#LocationSharing", "#OverSharing",
      "#PersonalInfoLeak", "#PhotoAccess", "#PrivacyPolicy", "#RemovedPrivacyToolOrFeature",
      "#RevengePorn", "#RightToBeForgotten", "#Surveillance", "#TextAccess", "#VideoAccess"
   ];
   
   $scope.causes = ["#3rdPartyApps", "#Accident", "#Attack", "#Bug", "#InsiderAttack",
      "#LawEnforcement", "#Legal", "#Malware", "#Misunderstanding", "#SecurityVulnerability",
      "#SocialMedia", "#StolenDevice", "#UnexpectedProductBehavior", "#UnclearConsent"
   ];
   
   $scope.locations = ["#Algeria", "#Argentina", "#Bangladesh", "#Brazil", "#Canada", "#China", 
      "#Colombia", "#Congo", "#Egypt", "#Ethiopia", "#France", "#Germany", "#India", "#Indoesia", 
      "#Iran", "#Iraq", "#Italy", "#Japan", "#Kenya", "#Mexico", "#Morocco", "#Myanmar", "#Nigeria", 
      "#Pakistan", "#Philippines", "#Poland", "#Russia", "#Saudiarabia", "#SouthAfrica", "#SouthKorea", 
      "#Spain", "#Sudan", "#Tanzania", "#Thailand", "#Turkey", "#Uganda", "#UK", "#Ukraine", "#USA", 
      "#Vietnam", "#World"
   ];
});