"""Use the official8/1160 verification policy for the compatible HEX companion."""
from pathlib import Path
source=Path(__file__).with_name('verify-ciw-completion-build10-official.py').read_text()
source=source.replace('official-build10','official-build10-v2')
source=source.replace('a1e488cc9429e0d803ed5a0149b4f0f2e25d4b49c54bb901bc7a2fa22e229aff','5c8a489bcfa7a0cb2eb1a4e80c7bf0955a01616aaa4fa8eda123de2862bd08be')
source=source.replace('0b3aa75cbb17a12fe558a9e4231587bcefbe917576074929293aa0b0902c3bae','26cebbed58ba519cb117d825929c6af1fc30a9cd6b9bf11d5895c6d44246763b')
exec(compile(source,__file__,'exec'))
