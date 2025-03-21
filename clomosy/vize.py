#BU DOSYA C-L-O-M-O-S-Y VE T-R-O-B-J-E-C-T DERS İÇERİĞİNİN NOTLARINI İÇERİR

# Değişken tanımlamak için ad : tip şeklinde tanımlama yapılır.
var
  sayi1, sayi2, sonuc, i:Integer; # Integer tamsayı tipidir.
  text1:String; # String karakter dizisi tipidir.
  arrayy:array of String; # Array dizi tipidir. of ifadesi ile dizi tipi belirtilir.
    isConfirmed: Boolean;  # Boolean mantıksal tipidir. True ya da False değer alır.
    accountNumber: Double; # Double ondalıklı sayı tipidir.
    floatingPointNumber: Float; # Float ondalıklı sayı tipidir.
    totalFees: Real;   #real ondalıklı sayı tipidir.

  

# void fonksiyon tanımlamak için void fonksiyonAdı şeklinde tanımlama yapılır.
# { } arasına fonksiyonun içeriği yazılır.
# ShowMessage fonksiyonu ekrana mesaj yazdırmak için kullanılır.
void voidFonksiyonAdi;
{
  ShowMessage('Gösterilecek mesaj');
}

# parametre alan fonksiyon tanımlamak için fonksiyonAdı(parametre1, parametre2:tip) şeklinde tanımlama yapılır.
# { } arasına fonksiyonun içeriği yazılır.
# ShowMessage fonksiyonu ekrana mesaj yazdırmak için kullanılır.
# IntToStr fonksiyonu integer değeri stringe çevirmek için kullanılır.
void toplama(sayi1, sayi2:Integer);
{
  ShowMessage(IntToStr(sayi1 + sayi2));
}

# geriye değer döndüren fonksiyon tanımlamak için fonksiyonAdı:tip şeklinde tanımlama yapılır.
# değişken tanımlamaya benzer şekilde tanımlama yapılır. tip burada fonksiyonun döndüreceği değerin tipidir.
# { } arasına fonksiyonun içeriği yazılır.
# result değişkeni fonksiyonun döndüreceği değeri tutar.
function donusTipliFonksiyonAdi:Integer;
{
  result = 5;
}

# parametre alan ve geriye değer döndüren fonksiyon tanımlamak için fonksiyonAdı(parametre1, parametre2:tip):tip
#  şeklinde tanımlama yapılır.
# değişken tanımlamaya benzer şekilde tanımlama yapılır. tip burada fonksiyonun döndüreceği değerin tipidir.
# { } arasına fonksiyonun içeriği yazılır.
# result değişkeni fonksiyonun döndüreceği değeri tutar.
function dondur2(sayi1, sayi2:Integer):Integer;
{
  result = sayi1 + sayi2;
}
  
  # main fonksiyonu buna benzer şekilde tanımlanır.
    # { } arasına fonksiyonun içeriği yazılır.
{
  sayi1 = 0;
  sayi2 = 4;
 #try bloğu içerisinde yazılan kodlar hata alacak olursa yakayıp yöntmek için kullanılır.
  try
    sonuc = sayi2 div sayi1;
    ShowMessage(sonuc);
  except
  #except bloğu try bloğu içerisinde hata alındığında çalışacak kodlar buraya yazılır.
  finally
    #finally bloğu try bloğu içerisinde hata alınsa da alınmasa da çalışacak kodlar buraya yazılır.
    ShowMessage('tum islemler tamamlandi');
  }
  
  # if ilginç bir şekilde "biz farklıyız çok başkayız" psikolojisinden çıkılarak mantıklı bir şekilde tasarlanmış
  # ve her kodlama dilinde olduğu şekliyle kullanılmaktadır.
  # if (koşul) { } şeklinde kullanılır.
  if (sayi1 == 0) {
    ShowMessage('sifir');
  }
  # else if (koşul) { } şeklinde kullanılır. eğer if koşulu sağlanmazsa bu koşul kontrol edilir.
  else if (sayi1 == 1) {
    ShowMessage('bir');
  }
    # else { } şeklinde kullanılır. eğer if ve else if koşulları sağlanmazsa bu blok çalışır.
  else {
    ShowMessage('not sifir');
  }
  
  #switch case yapısı burada yine mental osrunlar ile tasarlanmış şekilde 
  #saçma sapan alakasız bambaşka bir syntax ile karşımıza çıkmakta.
  # case aslen bir diziye benzer şekilde çalışır. case içerisindeki değerler bir dizi gibi sıralanır.
  # case içerisindeki değerlerden biri ile eşleşme sağlanırsa o case bloğu çalışır.
  sayi1 = 1;
  case sayi1 of {
    0: { ShowMessage('yes'); ShowMessage('ikinci'); }
    1: { ShowMessage('bir'); }
  }
  
  #repeat döngüsü while döngüsüne benzer şekilde çalışır.
    #repeat { } until (koşul) şeklinde kullanılır.
    #while döngüsünden farkı ise koşulun döngü bloğu çalıştıktan sonra kontrol edilmesidir.
    #yani kod bloğu en az bir kere çalışır.
  repeat
  sayi1 = sayi1 + 1;
  until (sayi1 > 5)
  
  //toplama(1,2);
  //sonuc = dondur1();
  //ShowMessage(sonuc);
  
  //sonuc = dondur2(3,5);
  //ShowMessage(sonuc);
  
  #// ile başlayan satırlar yorum satırıdır ve çalıştırılmaz.
  # /* ile başlayan ve */ ile biten satırlar arasındaki kodlar yorum satırıdır ve çalıştırılmaz.
  
  #while döngüsü bir koşul sağlandığı sürece çalışır.
    #while (koşul) { } şeklinde kullanılır.
  /*sayi1 = 1;
  while (sayi1 < 5) {
    ShowMessage(sayi1);
    sayi1 = sayi1 + 1;
  }*/
  
  #for döngüsü bir başlangıç değeri, bir bitiş değeri ve bir artış değeri alır.
  #for (başlangıç; koşul; artış) { } şeklinde kullanılır.
  //for (i=8 downto 1) {
  //  ShowMessage(i);
  //}

# array değeri ilginç bir şekilde yine mantıklı karakrlar ile her dilde olduğu gibi tanımlanmıştır.
  arrayy = ['deger1', 'deger2', 'deger3', 'deger3', 'deger3', 'deger3', 'deger9999'];
  ShowMessage(arrayy[6]);
  #arrayy[6]  6. indisteki değeri ifade eder.
  arrayy[6] = 'deger31';
  ShowMessage(arrayy[6]);
}

