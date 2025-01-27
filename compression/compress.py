from PIL import Image
from moviepy.video.io.VideoFileClip import VideoFileClip
from moviepy.video.fx import Resize
import os
import sys
import subprocess
import json
import shutil

# Absolute path to the directory you want to search
ROOT = os.path.join(os.path.dirname(os.path.realpath(__file__)), 'media')
COMPRESSED_DIR = os.path.join(os.path.dirname(os.path.realpath(__file__)), 'compressed')  # Directory to save compressed files
LANDSCAPE_DIR = os.path.join(os.path.dirname(os.path.realpath(__file__)), 'landscape')  # Directory to save uncompressed files
PREFIX = ''
SUFFIX = ''

FFMPEG_PATH = r"C:/Users/SECONDUSER/ffmpeg/bin/ffmpeg.exe"
FFPROBE_PATH = r"C:/Users/SECONDUSER/ffmpeg/bin/ffprobe.exe"

os.makedirs(LANDSCAPE_DIR, exist_ok=True)


def get_video_rotation(file_path):
    try:
        # Run ffprobe to get the video metadata
        command = [
            FFPROBE_PATH, '-v', 'quiet', '-print_format', 'json', 
            '-show_streams', '-select_streams', 'v:0', file_path
        ]
        result = subprocess.run(command, capture_output=True, text=True)
        
        if result.returncode != 0:
            print(f"Error running ffprobe: {result.stderr}")
            return None

        metadata = json.loads(result.stdout)

        # Check if there is a 'rotate' tag in the metadata
        rotate_tag = None
        for stream in metadata.get('streams', []):
            if 'side_data_list' in stream:
                for data_list in stream['side_data_list']:
                    if 'rotation' in data_list:
                        rotate_tag = data_list['rotation']
                        break

        if rotate_tag:
            print(f"Video rotation metadata found: {rotate_tag} degrees")
            return int(rotate_tag)
        else:
            print("No rotation metadata found.")
            return 0  # No rotation

    except Exception as e:
        print(f"Error retrieving video rotation: {e}")
        return None
    

def is_landscape(file_path, width, height):
    """
    Determines if the video is in landscape orientation.

    Args:
        file_path (str): Path to the video file.

    Returns:
        bool: True if the video is landscape, False if it's portrait.
    """
    rotation = abs(get_video_rotation(file_path))  # Get the rotation metadata

    # Adjust for rotation
    if rotation in [90, 270]:  # Rotated, so width and height are swapped
        width, height = height, width

    # Landscape orientation means width > height
    return width > height


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
        max_width_landscape = 1920  # Maximum width for landscape videos
        max_width_vertical = 1080  # Maximum width for vertical videos

        video = VideoFileClip(file_path)
        width, height = video.size

        # Determine if the video is landscape or vertical
        if is_landscape(file_path, width, height):
            max_width = max_width_landscape
            dest_path = os.path.join(LANDSCAPE_DIR, file_name)
            shutil.copy(file_path, dest_path)
            return f"Copied {file_name} to {LANDSCAPE_DIR}"
        else:
            max_width = max_width_vertical

        # Save the resized video
        compressed_path = os.path.join(COMPRESSED_DIR, file_name)
        video.write_videofile(compressed_path, codec='libx264', audio_codec='aac', bitrate='3000k')

        final_size = os.path.getsize(compressed_path)
        return f"Video compressed: Removed {round((original_size - final_size) / 1024 / 1024, 3)}MB"
    except Exception as e:
        return f"Error compressing video: {e}"


def main():
    assert os.path.isdir(ROOT)
    compress_files(ROOT)


if __name__ == '__main__':
    main()
