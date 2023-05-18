# Sơ bộ về Git
Để giới thiệu sơ bộ về Git, bạn có thể làm theo các bước sau:

Khởi tạo Git trong thư mục dự án của bạn với lệnh 

```
git init
```
Tạo một nhánh mới với lệnh 

```
git branch <branch_name>
```

Chuyển sang nhánh mới với lệnh 

```
git checkout <branch_name>
```

# Thực hiện một số thay đổi trên các tập tin trong thư mục của bạn.


Đưa các thay đổi vào khu vực chuẩn bị với lệnh 

```
git add <file> hoặc git add .
```

Commit các thay đổi với lệnh 

```
git commit -m "<commit_message>"
```
git push: Đưa các thay đổi từ kho lưu trữ cục bộ của bạn lên kho lưu trữ từ xa.

```
git push
```
git pull: Lấy các thay đổi từ kho lưu trữ từ xa và cập nhật kho lưu trữ cục bộ của bạn với các thay đổi đó.

```
git pull
```
Chuyển lại sang nhánh chính với lệnh 

```
git checkout main
```

Merge các thay đổi từ nhánh mới vào nhánh chính với lệnh 

```
git merge <branch_name>
```
# Các bước pull 

Lưu những thay đổi của bạn vào một nơi tạm thời bằng cách sử dụng lệnh git stash save:

```
git stash save "lưu các thay đổi trước khi kéo"
```
Thực hiện git pull để cập nhật nhánh cục bộ của bạn với các thay đổi từ nhánh từ xa:

```
git pull origin <tên_nhánh>
```
Áp dụng những thay đổi của bạn bằng cách sử dụng lệnh git stash apply:

```
git stash apply
```
Thêm những thay đổi vào khu vực staging bằng lệnh git add:

```
git add .
```
Commit những thay đổi với một thông điệp commit:

```
git commit -m "Thông điệp commit"
```
Đẩy những thay đổi lên nhánh từ xa bằng lệnh git push:

```
git push
```
