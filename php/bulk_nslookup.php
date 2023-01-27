<?php

$domains = explode("\n", <<<EOF
  hostbeter.nl
EOF
);

echo "domainname\tip-address\tnameserver 1\tnameserver 2\tmailserver\n";
foreach ($domains as $domain) {

    $domain = trim($domain);

    $a_record = dns_get_record($domain, DNS_A);
    $ns_record = dns_get_record($domain, DNS_NS);
    $mx_record = dns_get_record($domain, DNS_MX);

    $ip_address = $a_record[0] ? $a_record[0]['ip'] : '';
    $nameserver1 = $ns_record[0] ? $ns_record[0]['target'] : '';
    $nameserver2 = $ns_record[1] ? $ns_record[1]['target'] : '';
    $mailserver = $mx_record[0] ? $mx_record[0]['target'] : '';

    echo strtolower($domain . "\t" . $ip_address . "\t" . $nameserver1 . "\t" . $nameserver2 . "\t" . $mailserver . "\n");
}
