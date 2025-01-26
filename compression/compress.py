from PIL import Image
from moviepy.video.io.VideoFileClip import VideoFileClip
import os
import subprocess
import sys

# Absolute path to the directory you want to search
ROOT = os.path.join(os.path.dirname(os.path.realpath(__file__)), 'media')
COMPRESSED_DIR = os.path.join(os.path.dirname(os.path.realpath(__file__)), 'compressed')  # Directory to save compressed files
PREFIX = ''
SUFFIX = ''


def suppress_output(func):
    """Helper function to suppress stdout and stderr."""
    def wrapper(*args, **kwargs):
        with open(os.devnull, 'w') as devnull:
            sys.stdout = devnull
            sys.stderr = devnull
            result = func(*args, **kwargs)
            sys.stdout = sys.__stdout__
            sys.stderr = sys.__stderr__
        return result
    return wrapper


def compress_files(path):
    assert os.path.isdir(path)
    if not os.path.exists(COMPRESSED_DIR):
        os.makedirs(COMPRESSED_DIR)

    files = [f for f in os.listdir(path) if os.path.isfile(os.path.join(path, f)) 
             and str(f).startswith(PREFIX) and str(f).endswith(SUFFIX)]

    count = 0
    for file in files:
        try:
            file_path = os.path.join(path, file)
            original_size = os.path.getsize(file_path)

            if file.lower().endswith(('.png', '.jpg', '.jpeg', '.bmp', '.gif')):
                # Image compression
                compress_image(file_path, original_size, file)
                count += 1
            elif file.lower().endswith(('.mp4', '.mov', '.avi', '.mkv', '.flv')):
                # Video compression
                print(compress_video(file_path, original_size, file))
                count += 1
        except Exception as e:
            print(f"Error processing {file}: {e}")

    print(f"Compressed {count} files")
    input("Press ENTER to exit")


def compress_image(file_path, original_size, file_name):
    try:
        max_width = 1920
        image = Image.open(file_path)
        width, height = image.size
        aspect_ratio = width / height
        new_height = max_width / aspect_ratio
        image = image.resize((max_width, round(new_height)))
        
        # Save the compressed image in the 'compressed' directory
        compressed_path = os.path.join(COMPRESSED_DIR, file_name)
        image.save(compressed_path, optimize=True, quality=85)
        final_size = os.path.getsize(compressed_path)
        print(f"Image compressed: Removed {round((original_size - final_size) / 1024 / 1024, 3)}MB")
    except Exception as e:
        print(f"Error compressing image: {e}")


@suppress_output
def compress_video(file_path, original_size, file_name):
    try:
        max_width = 1920
        video = VideoFileClip(file_path)
        width, height = video.size
        if width > max_width:
            aspect_ratio = width / height
            new_height = max_width / aspect_ratio
            video = video.resize(height=round(new_height))  # Resize while maintaining aspect ratio

        # Save the compressed video in the 'compressed' directory
        compressed_path = os.path.join(COMPRESSED_DIR, file_name)
        video.write_videofile(compressed_path, codec='libx264', audio_codec='aac', bitrate='800k')

        final_size = os.path.getsize(compressed_path)
        return f"Video compressed: Removed {round((original_size - final_size) / 1024 / 1024, 3)}MB"
    except Exception as e:
        return f"Error compressing video: {e}"


def main():
    assert os.path.isdir(ROOT)
    compress_files(ROOT)


if __name__ == '__main__':
    main()
