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
});