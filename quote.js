
setInterval(alertFunc, 5000);


function alertFunc() {


var greetings = [
      "Keep calm, don't be too hasty to get the best proxy."
    , "Keep your firewall active!"
    , "Please don't use VPN to generate the proxies."
    , "You blocked? keep calm, you will be unblocked after a few hours."
    , "Use VPN can block your activities to generate proxies"
    , "Follow our rules so that your account activity isn't blocked."
    , "Having problems? Try to contact us https://p-store.net/conversations/S3M4RM3S3M."
];
var greeting_id = Math.floor(Math.random() * greetings.length);
document.getElementById('here').innerHTML = greetings[greeting_id];
}