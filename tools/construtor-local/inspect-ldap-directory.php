<?php
// RootDSE anonimo; nao recebe nem tenta senhas de usuarios.
if(!extension_loaded('ldap'))throw new RuntimeException('Extensao LDAP ausente');
function probe(string $host,int $port,bool $startTls=false):array{
 $c=ldap_connect($host.':'.$port);ldap_set_option($c,LDAP_OPT_PROTOCOL_VERSION,3);ldap_set_option($c,LDAP_OPT_REFERRALS,0);ldap_set_option($c,LDAP_OPT_NETWORK_TIMEOUT,5);ldap_set_option($c,LDAP_OPT_TIMELIMIT,5);
 if($startTls&&!@ldap_start_tls($c)){ $n=ldap_errno($c);ldap_unbind($c);return ['connected'=>false,'tls'=>false,'ldapCode'=>$n]; }
 $r=@ldap_read($c,'','(objectClass=*)',['defaultNamingContext','dnsHostName','supportedLDAPVersion']);
 if(!$r){$n=ldap_errno($c);ldap_unbind($c);return ['connected'=>false,'ldapCode'=>$n];}
 $e=ldap_get_entries($c,$r);$out=['connected'=>true];
 foreach(['defaultnamingcontext','dnshostname','supportedldapversion'] as $k)if(isset($e[0][$k]))$out[$k]=array_values(array_filter($e[0][$k],'is_string'));
 ldap_unbind($c);return $out;
}
$root=probe('ldap://192.168.0.61',389);$result=['rootDse'=>$root];
$host=$root['dnshostname'][0]??null;
if(is_string($host)&&preg_match('/^[A-Za-z0-9.-]+$/',$host)){
 $result['dnsResolves']=gethostbyname($host)!==$host;
 if($result['dnsResolves']){$result['ldaps']=probe('ldaps://'.$host,636);$result['startTls']=probe('ldap://'.$host,389,true);}
}
$state=dirname(__DIR__,2).'/.runtime/ciw-ldap-20261020';if(!is_dir($state))mkdir($state,0700,true);
file_put_contents($state.'/directory-probe.json',json_encode($result,JSON_THROW_ON_ERROR|JSON_PRETTY_PRINT));echo json_encode($result,JSON_THROW_ON_ERROR).PHP_EOL;
