# JigsawGroups_test
 ใช้เพื่อทำแบบทดสอบฝึกงาน

 # Short URL Generator

ระบบนี้พัฒนาขึ้นเพื่อใช้งานในการสร้าง **Short URL และ QR Code** 
พัฒนาโดยใช้ HTML PHP SQL JavaScript Bootstrap5 
ใช้ library # **PHP QR Code Files** ในการสร้าง QR Code


# ขั้นตอนการติดตั้ง

1. ดาวน์โหลดแตกไฟล์นำไปติดตั้งยัง **path** ที่ต้องการ
2. สร้างฐานข้อมูลชื่อ **db_shorturl**
3. ติดตั้งฐานข้อมูล จากไฟล์ **db.sql**
4. เปิดไฟล์ **php.ini** 
![enter image description here](https://media.discordapp.net/attachments/882548609562861568/1088526214861426730/image.png?width=1140&height=490)
ค้นหา **extension=gd** ลบ **;** ด้านหน้าออก
**`;extension=gd`** => **`extension=gd`**

5. แก้ไขไฟล์ **functions.php** ในโฟลเดอร์ **Function** ที่ `$domain = "ชื่อโดเมน"`

ทดลองเข้าใช้งานเว็ปไซต์



## วิธีการใช้งาน

นำลิ้ง URL ใส่ในช่อง "ระบุ URL"
จากนั้นกดปุ่ม "สร้าง Short URL"
ลิ้งที่ทำการสร้างจะแสดงมาด้านบนสุดของตาราง
สามารถกด "แสดงรายละเอียด" เพื่อคัดลอก QR Code และ ลิ้งค์ที่ได้ทำการย่อแล้ว

**ผู้ดูแล**
สามารถ ดูจำนวนการเข้าลิ้ง
สามารถ ลบลิ้งที่ทำการย่อไว้ได้

## เครดิต

**library for generating QR Code** : [deltalab](https://sourceforge.net/projects/phpqrcode/)
**Short URL Reference** : [Youtube CodingNepal](https://www.youtube.com/@CodingNepal)
**QR Code Generator Reference** : [Youtube TechAreaIndia](https://www.youtube.com/@TechAreaIndia)

