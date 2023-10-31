from PIL import Image
import os


# Absolute path to the directory you want to search
ROOT = os.path.join(os.path.dirname(os.path.realpath(__file__)), 'images')
PREFIX = ''
SUFFIX = ''


def compressFiles(path):
    assert os.path.isdir(path)
    files = [f for f in os.listdir(path) if os.path.isfile(os.path.join(path, f)) if str(f).startswith(PREFIX) and str(f).endswith(SUFFIX)]

    print("---FILES---")
    for file in files:
        print(file)

    count = 0
    for file in files:
        try:
            maxWidth = 1920
            filePath = os.path.join(path, file)
            originalSize = os.path.getsize(filePath)
            image = Image.open(filePath)
            width, height = image.size
            aspectRatio = width / height
            newHeight = maxWidth / aspectRatio
            image = image.resize((maxWidth, round(newHeight)))
            image.save(filePath, optimize=True, quality=85)
            finalSize = os.path.getsize(filePath)
            print(f"Removed {round((originalSize-finalSize)/1024/1024, 3)}MB")
            count += 1
        except Exception as e:
            print(e)
        print(f"Compressed {count} files")

    input("Press ENTER to exit")


def main():
    assert os.path.isdir(ROOT)
    compressFiles(ROOT)


if __name__ == '__main__':
    main()