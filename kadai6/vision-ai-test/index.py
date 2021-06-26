# visionをインポート
from google.cloud import vision
# image.jpgを開いて読み込む
with open('./images/11.jpeg', 'rb') as image_file:
    content = image_file.read()
#vision APIが扱える画像データにする
image = vision.Image(content=content)
#ImageAnnotatorClientのインスタンスを生成
# もしここでエラーが出るならもう一度ターミナルでexport GOOGLE_APPLICATION_CREDENTIALSを行う
annotator_client = vision.ImageAnnotatorClient()
response_data = annotator_client.label_detection(image=image)
labels = response_data.label_annotations

print('----RESULT----')
# listに配列を作る(Scarを特定するため)
list = []
for label in labels:
    print(label.description, ':', round(label.score * 100, 1), '%')
    list.append(label.description)

print('----RESULT----')
print(list)

if "Scar" in list:
    print("医者に見てもらいましょう")
else:
    print("正常です")

print('----RESULT----')


