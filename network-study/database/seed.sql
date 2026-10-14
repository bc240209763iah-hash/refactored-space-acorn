USE network_study;

INSERT INTO users (id, username, email, password_hash, full_name) VALUES
(1, 'admin', 'admin@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Study Admin');

INSERT INTO courses (id, user_id, name, description, category, target_goal, target_start_date, target_end_date, priority, estimated_hours, daily_target_hours, status, color, icon) VALUES
(1, 1, 'CCNP ENCOR 350-401', 'Enterprise networking study plan based on Cisco Press and Network Nuggets course material.', 'Networking', 'CCNP ENCOR 350-401', '2026-10-01', '2027-02-28', 'high', 120.00, 1.50, 'active', '#4f46e5', 'book-open'),
(2, 1, 'CCNA', 'Associate-level networking fundamentals and practical troubleshooting review.', 'Networking', 'CCNA certification', '2026-09-15', '2026-12-31', 'medium', 60.00, 1.00, 'active', '#16a34a', 'network'),
(3, 1, 'Linux Fundamentals', 'Command-line workflow, shell usage, process control, and storage basics.', 'Linux', 'Linux fundamentals', '2026-10-10', '2027-01-10', 'medium', 40.00, 1.00, 'paused', '#f59e0b', 'terminal');

INSERT INTO modules (id, course_id, title, description, sort_order) VALUES
(1, 1, 'Forwarding', 'Packet handling and architecture fundamentals.', 1),
(2, 1, 'Layer 2', 'VLANs, switching, and trunking.', 2),
(3, 1, 'Routing', 'Static, dynamic, and policy-based routing.', 3),
(4, 1, 'Services', 'NAT, QoS, DHCP, and application services.', 4),
(5, 1, 'Overlay', 'VPNs, tunnels, DMVPN, and overlay strategy.', 5),
(6, 1, 'Wireless', 'Wireless architecture and client connectivity.', 6),
(7, 1, 'Architecture', 'SD-Access and campus design principles.', 7),
(8, 1, 'Security', 'Access control, segmentation, and protection.', 8),
(9, 1, 'Automation', 'Programmability, APIs, and automation workflows.', 9);

INSERT INTO topics (id, module_id, title, description, sort_order) VALUES
(1, 1, 'IP packet forwarding', 'Understand the switching and routing path of packets.', 1),
(2, 1, 'Frame switching basics', 'Address learning, CAM tables, and flooding behavior.', 2),
(3, 2, 'VLANs and trunking', 'VLANs, dot1q, and inter-switch connectivity.', 1),
(4, 3, 'OSPF fundamentals', 'Area design, neighbor relationships, and LSAs.', 1),
(5, 3, 'IP routing selection', 'Longest match, administrative distance, and routing protocols.', 2),
(6, 4, 'DHCP and NAT', 'Address allocation and translation behavior.', 1),
(7, 8, 'Secure access controls', 'ACLs, port security, and segmentation principles.', 1),
(8, 9, 'Python automation basics', 'Automating repeated checks with Python and scripting.', 1);

INSERT INTO lessons (id, topic_id, title, objectives, content, status, estimated_minutes, video_title, video_url, book_pages, sort_order) VALUES
(1, 1, 'Packet forwarding fundamentals', 'Explain the end-to-end forwarding process and where routing and switching decisions occur.', 'Study how frames are switched and packets are routed. Focus on the control plane versus forwarding plane and frame processing at each hop.', 'in_progress', 40, 'ENCOR Forwarding Part 1', 'https://example.com/video/forwarding', 'Ch 1, pp. 1-30', 1),
(2, 3, 'VLANs and trunking review', 'Describe VLAN membership, trunk encapsulation, and native VLAN behavior.', 'Review the process of creating VLANs, trunk permits, and common trunking issues that impact communication.', 'pending', 35, 'VLANs deep dive', 'https://example.com/video/vlans', 'Ch 3, pp. 80-120', 1),
(3, 4, 'OSPF neighbor formation', 'Verify adjacencies, area design, and basic OSPF packet exchange.', 'Compare hello/dead timers, interface states, and neighbor formation logic using route table review and debug commands.', 'pending', 45, 'OSPF basics', 'https://example.com/video/ospf', 'Ch 6, pp. 220-260', 1),
(4, 6, 'DHCP and NAT design', 'Describe how DHCP and NAT work in campus and edge networks.', 'Explain lease timing, relay agents, and translation flows for NAT and PAT in enterprise designs.', 'pending', 30, 'DHCP and NAT', 'https://example.com/video/dhcp-nat', 'Ch 8, pp. 320-370', 1),
(5, 7, 'Access control and device protection', 'Understand ACLs, port security, and secure administrative practices.', 'Document common mistakes when applying ACLs and limitations of stateless filtering in layered security models.', 'pending', 35, 'Security controls', 'https://example.com/video/security-controls', 'Ch 13, pp. 570-620', 1),
(6, 8, 'Python automation for network checks', 'Create a simple script to parse interface status and collect facts.', 'Use Python to interact with devices or files, make repeated checks easier, and document your outputs.', 'pending', 50, 'Python scripting intro', 'https://example.com/video/python-net', 'App automation notes', 1);

INSERT INTO lesson_progress (lesson_id, progress_percent, status, reviewed_at) VALUES
(1, 60, 'in_progress', NOW()),
(2, 15, 'pending', NULL),
(3, 0, 'pending', NULL),
(4, 0, 'pending', NULL),
(5, 0, 'pending', NULL),
(6, 0, 'pending', NULL);

INSERT INTO lesson_notes (lesson_id, note_title, note_body) VALUES
(1, 'Packet forwarding notes', 'Forwarding decisions happen in hardware for Layer 2 and in the routing table for Layer 3. I should always verify adjacency and interface state before assuming the path is correct.');

INSERT INTO study_tasks (course_id, lesson_id, title, description, due_date, due_time, duration_minutes, status) VALUES
(1, 1, 'Read forwarding chapter', 'Review Cisco Press chapter and summarize the forwarding plane.', '2026-10-16', '19:00:00', 60, 'pending'),
(1, 2, 'Lab: VLAN trunk verification', 'Verify allowed VLANs and native VLAN mismatch behavior.', '2026-10-18', '20:00:00', 45, 'pending'),
(2, 1, 'CCNA recap block', 'Review subnetting and addressing fundamentals.', '2026-10-20', '18:30:00', 30, 'pending');

INSERT INTO study_sessions (user_id, lesson_id, session_date, duration_minutes, notes, status) VALUES
(1, 1, '2026-10-13', 45, 'Reviewed packet flow and forwarding behavior.', 'completed'),
(1, 1, '2026-10-14', 30, 'Updated notes and confirmed route lookup process.', 'completed');

INSERT INTO quiz_questions (id, course_id, topic_id, question_text, question_type, difficulty, explanation) VALUES
(1, 1, 1, 'Which statement best describes the forwarding decision for a frame arriving on a switch port?', 'multiple_choice', 'medium', 'A switch makes a Layer 2 forwarding decision using the MAC address table and VLAN context.'),
(2, 1, 4, 'OSPF neighbors form after a successful Hello exchange.', 'true_false', 'easy', 'OSPF uses Hello packets to establish neighbor adjacencies when the interface settings match.');

INSERT INTO question_options (question_id, option_text, is_correct) VALUES
(1, 'It checks the routing table and chooses the best destination interface.', 0),
(1, 'It uses the MAC address table and local VLAN mapping to determine the egress port.', 1),
(1, 'It always floods the frame unless a static route exists.', 0),
(1, 'It strips the Layer 2 header before forwarding any traffic.', 0),
(2, 'True', 1),
(2, 'False', 0);

INSERT INTO flashcards (id, course_id, topic_id, question, answer, tags, difficulty, next_review_at, review_count, last_reviewed_at) VALUES
(1, 1, 1, 'What is the purpose of a switch CAM table?', 'It stores MAC-to-port mappings used to forward frames within a local VLAN.', 'switching, cam, forwarding', 'medium', '2026-10-15 08:00:00', 1, '2026-10-14 08:00:00'),
(2, 1, 4, 'What does OSPF use to discover neighbors?', 'OSPF uses Hello packets sent on compatible interfaces to establish neighbor relationships.', 'ospf, routing, protocol', 'easy', '2026-10-16 08:00:00', 0, NULL);

INSERT INTO labs (id, course_id, lesson_id, title, objective, required_tools, topology_description, expected_outcome, difficulty, status, time_minutes) VALUES
(1, 1, 2, 'VLAN trunk verification lab', 'Validate VLAN traffic handling and identify mismatch risk.', 'Packet Tracer or GNS3, 2 switches', 'Two switches connected via trunk and a workstation on each VLAN.', 'Traffic should flow according to VLAN permissions and trunk allowed list.', 'medium', 'planned', 60);

INSERT INTO lab_tasks (lab_id, title, details, status) VALUES
(1, 'Create VLANs', 'Create VLAN 10 and VLAN 20 on both switches.', 'pending'),
(1, 'Configure trunk interface', 'Allow required VLANs and verify native VLAN settings.', 'pending');

INSERT INTO resources (course_id, lesson_id, name, type, file_path, url, description) VALUES
(1, 1, 'ENCOR Chapter 1 Notes', 'pdf', '', 'https://example.com/resource/encor-ch1', 'Personal notes and chapter summary for forwarding basics.');
