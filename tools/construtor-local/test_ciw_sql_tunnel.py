import importlib.util,socket,unittest
from pathlib import Path
class TunnelTests(unittest.TestCase):
 def load(self):
  p=Path(__file__).with_name('ciw-sql-tunnel.py');spec=importlib.util.spec_from_file_location('ciw_tunnel',p);m=importlib.util.module_from_spec(spec);spec.loader.exec_module(m);return m
 def test_fixed_target_and_dead_transport(self):
  m=self.load()
  for h,p in [('0.0.0.0',19933),('127.0.0.1',1433)]:
   with self.assertRaises(ValueError):m.SqlTunnel(None,h,p)
  class Dead:
   def is_active(self):return False
  with self.assertRaises(ConnectionError):
   with m.SqlTunnel(Dead()):pass
 def test_owned_listener_cleanup_and_port_collision(self):
  m=self.load()
  class Live:
   def is_active(self):return True
  with m.SqlTunnel(Live()):
   with self.assertRaises(OSError):
    with m.SqlTunnel(Live()):pass
  with socket.socket() as probe:probe.bind(('127.0.0.1',19933))
if __name__=='__main__':unittest.main()
